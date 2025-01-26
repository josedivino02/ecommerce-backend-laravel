<?php

namespace App\Services\Auth;

use App\Contracts\Services\AuthServiceInterface;

class AuthService
{
    public function __construct(protected AuthServiceInterface $authService)
    {
    }

    public function login(array $credentials): array
    {
        $token = $this->authService->attempt($credentials);

        if (!$token) {
            return [];
        }

        return $this->payLoad($token);
    }

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
