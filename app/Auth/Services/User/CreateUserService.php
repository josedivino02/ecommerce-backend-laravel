<?php

namespace App\Auth\Services\User;

use App\Auth\Contracts\Repositories\UserRepositoryInterface;
use App\Auth\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): User
    {

        $data["uuid"]     = Str::uuid();
        $data["password"] = Hash::make($data["password"]);

        return $this->userRepository
            ->create($data);
    }
}
