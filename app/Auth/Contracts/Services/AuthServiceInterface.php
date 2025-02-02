<?php

namespace App\Auth\Contracts\Services;

use App\Auth\Models\User;

interface AuthServiceInterface
{
    public function attempt(array $credentials): ?string;
    public function logout(): bool;
    public function authenticate(): User|null;
}