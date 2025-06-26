<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class SessionAuth
{
    public function handle(Request $request, Closure $next)
    {
        $accessToken = session('access_token');
        $user = session('user');

        if (!$accessToken || !$user) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Optional: Validate token by making a test API call
        // This ensures the token is still valid
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->get(url('/api/v1/user'));

            if ($response->status() === 401) {
                // Token is invalid, clear session and redirect
                session()->forget(['access_token', 'refresh_token', 'user']);
                return redirect()->route('login')->with('error', 'Your session has expired. Please login again.');
            }

        } catch (\Exception $e) {
            \Log::warning('Token validation failed: ' . $e->getMessage());
            // Continue anyway - maybe the API is down
        }

        return $next($request);
    }
}
