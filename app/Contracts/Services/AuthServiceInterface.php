<?php

namespace App\Contracts\Services;

interface AuthServiceInterface
{
    public function attempt(array $credentials): ?string;
}
