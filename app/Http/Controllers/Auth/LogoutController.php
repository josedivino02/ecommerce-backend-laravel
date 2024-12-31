<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\{JWTException, TokenExpiredException, TokenInvalidException};
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function logout()
    {
        try {
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Token is invalid or expired!'], Response::HTTP_UNAUTHORIZED);
            }

            JWTAuth::invalidate(JWTAuth::getToken());

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
