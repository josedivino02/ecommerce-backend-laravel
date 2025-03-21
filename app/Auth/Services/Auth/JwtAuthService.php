<?php

namespace App\Auth\Services\Auth;

use App\Auth\Contracts\Services\AuthServiceInterface;
use App\Auth\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthService implements AuthServiceInterface
{
    /**
     * @param array<string, mixed> $credentials
     */
    public function attempt(array $credentials): string|null
    {
        return JWTAuth::attempt($credentials);
    }

    public function logout(): bool
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken(), false);

            return true;
        } catch (\Throwable) {
            return false;
        }

    }

    public function authenticate(): ?User
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            return $user instanceof User ? $user : null;
        } catch (JWTException) {
            return null;
        }
    }
}
