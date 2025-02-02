<?php

namespace App\Auth\Services\Auth;

use App\Auth\Contracts\Services\AuthServiceInterface;
use App\Auth\Models\User;

use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthService implements AuthServiceInterface
{
    public function attempt(array $credentials): string|null
    {
        return JWTAuth::attempt($credentials);
    }

    public function logout(): bool
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return true;
        } catch (\Throwable $th) {
            return false;
        }

    }

    public function authenticate(): User|null
    {
        return JWTAuth::parseToken()->authenticate();
    }
}