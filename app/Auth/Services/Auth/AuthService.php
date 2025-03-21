<?php

namespace App\Auth\Services\Auth;

use App\Auth\Contracts\Services\AuthServiceInterface;
use App\Auth\Models\User;

class AuthService
{
    public function __construct(protected AuthServiceInterface $authService)
    {
    }

    /**
     * @param array<string, mixed> $credentials
     * @return array<string, mixed>
     */
    public function login(array $credentials): array
    {
        $token = $this->authService->attempt($credentials);

        if ($token === null || $token === '' || $token === '0') {
            return [];
        }

        return $this->payLoad($token);
    }

    public function authenticate(): bool
    {
        return $this->authService->authenticate() instanceof User;
    }

    public function logout(): void
    {
        $this->authService->logout();
    }

    /**
     * @return array<string, mixed>
     */
    private function payLoad(string $token): array
    {
        $user = user();

        return [
            'access_token' => $token,
            'token_type'   => "bearer",
            "expires_in"   => config('jwt.ttl') * 60,
            "user"         => [
                "id"    => $user->id,
                "uuid"  => $user->uuid,
                "name"  => $user->name,
                "email" => $user->email,
            ],
        ];
    }
}
