<?php

namespace App\Contracts\Services\Auth;

use App\Models\User;

interface AuthServiceInterface
{
    public function attempt(array $credentials): ?string;
    public function logout(): bool;
    public function authenticate(): User|null;
}