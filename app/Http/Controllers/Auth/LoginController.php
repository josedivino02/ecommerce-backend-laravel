<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email"    => ["required", "email"],
            "password" => ["required"],
        ]);

        $credentials = $request->only("email", "password");

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials!'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'It was not possible to create the token.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(
            [
                'access_token' => $token,
                'token_type'   => "bearer",
                "expires_in"   => config('jwt.ttl') * 60,
            ],
            Response::HTTP_OK
        );
    }
}
