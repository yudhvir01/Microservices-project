<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Http\Controllers\AccessTokenController as PassportAccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AccessTokenController extends PassportAccessTokenController
{
    use ApiResponser;

    public function issueToken(ServerRequestInterface $request)
    {
        try {
            \Log::info('AccessTokenController: Starting token issuance');

            // Validate the request
            $validator = Validator::make($request->getParsedBody(), [
                'grant_type' => "required",
                'client_id' => "required",
                'client_secret' => "required",
                'username' => "required",
                'password' => "required",
            ]);

            if ($validator->fails()) {
                \Log::error('AccessTokenController: Validation failed', $validator->errors()->toArray());
                return $this->response($validator->messages()->first(), Response::HTTP_BAD_REQUEST);
            }

            // Get username (default is :email)
            $username = $request->getParsedBody()['username'];
            \Log::info('AccessTokenController: Looking for user', ['username' => $username]);

            // Get user
            $user = User::where('email', '=', $username)->first();

            // If user does not exist throw an exception
            if (!$user) {
                \Log::error('AccessTokenController: User not found', ['username' => $username]);
                throw new ModelNotFoundException("User with this email does not exists");
            }

            \Log::info('AccessTokenController: User found', ['user_id' => $user->id, 'email' => $user->email]);

            // Check if the email of the user is verified
            if (!$user->hasVerifiedEmail()) {
                \Log::error('AccessTokenController: Email not verified', ['user_id' => $user->id]);
                $user->sendEmailVerificationNotification();
                return $this->response('Your account is not verified. Please check your email for a new verification link.', Response::HTTP_FORBIDDEN);
            }

            \Log::info('AccessTokenController: Email verified, generating token');

            // Generate token
            $tokenResponse = parent::issueToken($request);

            \Log::info('AccessTokenController: Token response received', [
                'status' => $tokenResponse->getStatusCode(),
                'content' => $tokenResponse->getContent()
            ]);

            // Convert response to json string
            $content = $tokenResponse->getContent();

            // Convert json to array
            $data = json_decode($content, true);

            if (isset($data["error"])) {
                \Log::error('AccessTokenController: OAuth error in response', ['error' => $data["error"]]);

                // More specific error handling based on error type
                $errorType = $data["error"] ?? 'unknown_error';
                $errorMessage = $data["message"] ?? $data["error_description"] ?? 'Authentication failed';

                switch ($errorType) {
                    case 'invalid_client':
                        \Log::error('AccessTokenController: Invalid client credentials');
                        return $this->response('Invalid client credentials. Please check client_id and client_secret.', Response::HTTP_UNAUTHORIZED);

                    case 'invalid_grant':
                        \Log::error('AccessTokenController: Invalid grant - likely wrong username/password');
                        return $this->response('Invalid username or password.', Response::HTTP_UNAUTHORIZED);

                    default:
                        \Log::error('AccessTokenController: OAuth error', ['error' => $errorType, 'message' => $errorMessage]);
                        return $this->response($errorMessage, Response::HTTP_BAD_REQUEST);
                }
            }

            \Log::info('AccessTokenController: Token generated successfully');
            return $this->response('Access granted', Response::HTTP_OK, $data);

        } catch (ModelNotFoundException $e) { // email not found
            \Log::error('AccessTokenController: ModelNotFoundException', ['message' => $e->getMessage()]);
            return $this->response('User not found', Response::HTTP_NOT_FOUND);

        } catch (OAuthServerException $e) { // OAuth specific errors
            \Log::error('AccessTokenController: OAuthServerException', [
                'message' => $e->getMessage(),
                'error_type' => $e->getErrorType(),
                'status_code' => $e->getHttpStatusCode()
            ]);

            // Handle specific OAuth errors
            switch ($e->getErrorType()) {
                case 'invalid_client':
                    return $this->response('Client authentication failed. Check client credentials.', Response::HTTP_UNAUTHORIZED);
                case 'invalid_grant':
                    return $this->response('Invalid username or password.', Response::HTTP_UNAUTHORIZED);
                default:
                    return $this->response('Authentication failed: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $e) {
            \Log::error('AccessTokenController: General Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Refreshes an access token using a refresh_token provided during access token
     * @param \Psr\Http\Message\ServerRequestInterface
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(ServerRequestInterface $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->getParsedBody(), [
                'grant_type' => "required",
                'client_id' => "required",
                'client_secret' => "required",
                'refresh_token' => "required",
            ]);

            if ($validator->fails()) {
                return $this->response($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            // Generate token
            $tokenResponse = parent::issueToken($request);

            // Convert response to json string
            $content = $tokenResponse->getContent();

            // Convert json to array
            $data = json_decode($content, true);

            if (isset($data["error"])) {
                \Log::error('AccessTokenController: Refresh token error', ['error' => $data["error"]]);
                throw new OAuthServerException($data["error"], 0, $data["error"], $tokenResponse->getStatusCode());
            }

            return $this->response('Token refreshed.', Response::HTTP_OK, $data);

        } catch (OAuthServerException $e) {
            \Log::error('AccessTokenController: Refresh OAuthServerException', ['message' => $e->getMessage()]);
            return $this->response($e->getMessage(), Response::HTTP_BAD_REQUEST);

        } catch (Exception $e) {
            \Log::error('AccessTokenController: Refresh General Exception', ['message' => $e->getMessage()]);
            return $this->response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
