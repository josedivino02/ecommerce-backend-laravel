<?php

namespace App\Services\Auth;

use App\Contracts\Services\AuthServiceInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthService implements AuthServiceInterface
{
    public function attempt(array $credentials): string|null
    {
        return JWTAuth::attempt($credentials);
    }

    public function logout(): JWTAuth
    {
        return JWTAuth::invalidate(JWTAuth::getToken());
    }

    public function authenticate(): JWTAuth
    {
        return JWTAuth::parseToken()->authenticate();
    }
}
