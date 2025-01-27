<?php

namespace App\Contracts\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

interface AuthServiceInterface
{
    public function attempt(array $credentials): ?string;
    public function logout(): JWTAuth;
    public function authenticate(): JWTAuth;
}
