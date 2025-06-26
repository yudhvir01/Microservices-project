<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Exception;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the registration form
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        try {
            // Use the same validation as your OAuth controller
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Debug: Check if user exists
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->withErrors(['email' => 'No user found with this email address'])->withInput();
            }

            // Debug: Check if password is correct
            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors(['email' => 'Password does not match'])->withInput();
            }

            // Get OAuth client credentials from config
            $clientId = config('passport.password_client.id');
            $clientSecret = config('passport.password_client.secret');

            // Debug: Log the request data
            \Log::info('OAuth Request Data:', [
                'grant_type' => 'password',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => $request->email,
                'password' => $request->password,
            ]);

            // Make internal request to your OAuth endpoint
            $response = Http::post(url('/api/v1/token'), [
                'grant_type' => 'password',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => $request->email,
                'password' => $request->password,
            ]);

            // Debug: Log the response
            \Log::info('OAuth Response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            $responseData = $response->json();

            // Check if your API returned success in the custom format
            if ($responseData['resCode'] == 200 && $responseData['resStatus'] == 'success') {
                $tokenData = $responseData['data'];

                // Store token in session
                session([
                    'access_token' => $tokenData['access_token'],
                    'refresh_token' => $tokenData['refresh_token'],
                    'user' => $user,
                    'token_expires_at' => now()->addSeconds($tokenData['expires_in'])->toDateTimeString(),
                ]);

                return redirect()->intended('/dashboard')->with('success', 'Login successful!');
            } else {
                // Handle specific error messages
                $errorMessage = $responseData['resMsg'] ?? 'Invalid credentials';

                // Check if it's an email verification issue
                if (str_contains($errorMessage, 'not verified')) {
                    return back()->withErrors(['email' => 'Please verify your email before logging in. Check your inbox for the verification link.'])->withInput();
                }

                return back()->withErrors(['email' => $errorMessage])->withInput();
            }

        } catch (Exception $e) {
            // Log the actual error for debugging
            \Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'An error occurred during login: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Send email verification if required
            if (method_exists($user, 'sendEmailVerificationNotification')) {
                $user->sendEmailVerificationNotification();
                return redirect('/login')->with('success', 'Registration successful! Please check your email to verify your account.');
            }

            return redirect('/login')->with('success', 'Registration successful! You can now login.');

        } catch (Exception $e) {
            return back()->withErrors(['email' => 'An error occurred during registration'])->withInput();
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        try {
            $accessToken = session('access_token');

            if ($accessToken) {
                // Optionally revoke the token on the server
                // You can make an API call to revoke it if needed
            }

            // Clear session
            session()->forget(['access_token', 'refresh_token', 'user']);
            session()->flush();

            return redirect()->route('login')->with('success', 'Successfully logged out.');

        } catch (Exception $e) {
            \Log::error('Logout error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'An error occurred during logout.');
        }
    }

    /**
     * Refresh token
     */
    public function refreshToken(Request $request)
    {
        try {
            $refreshToken = session('refresh_token');

            if (!$refreshToken) {
                return redirect('/login')->with('error', 'Session expired. Please login again.');
            }

            $clientId = config('passport.password_client.id');
            $clientSecret = config('passport.password_client.secret');

            $response = Http::post(url('/oauth/refresh'), [
                'grant_type' => 'refresh_token',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'refresh_token' => $refreshToken,
            ]);

            if ($response->successful()) {
                $tokenData = $response->json();

                session([
                    'access_token' => $tokenData['data']['access_token'],
                    'refresh_token' => $tokenData['data']['refresh_token'],
                ]);

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false], 401);

        } catch (Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }
}
