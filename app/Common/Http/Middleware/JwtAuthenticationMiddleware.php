<?php

namespace App\Common\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\{JWTException, TokenExpiredException, TokenInvalidException};
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthenticationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json(["error" => "The access token has expired, please log in again."], Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json(["error" => "The access token is invalid, log in again to generate a valid token"], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json(["error" => "Token not provided, please log in"], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}