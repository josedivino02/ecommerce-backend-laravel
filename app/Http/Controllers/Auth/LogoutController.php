<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\{JWTException, TokenExpiredException, TokenInvalidException};

class LogoutController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function logout()
    {
        try {
            if (!$this->authService->authenticate()) {
                return response()->json(['error' => 'Token is invalid or expired!'], Response::HTTP_UNAUTHORIZED);
            }

            $this->authService->logout();

            return response()->json(["message" => "Successful logout!"], Response::HTTP_OK);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid!'], Response::HTTP_UNAUTHORIZED);
        } catch (TokenExpiredException $e) {
            return response()->json(["message" => "Token has already expired!"], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json(["error" => "Unable to logout, token not provided!"], Response::HTTP_BAD_REQUEST);
        }
    }
}
