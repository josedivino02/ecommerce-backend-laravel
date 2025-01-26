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
}
