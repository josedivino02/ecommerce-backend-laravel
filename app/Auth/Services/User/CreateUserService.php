<?php

namespace App\Auth\Services\User;

use App\Auth\Models\User;
use App\Auth\Contracts\Repositories\UserRepositoryInterface;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function create(array $data): User
    {

        $data["uuid"]     = Str::uuid();
        $data["password"] = Hash::make($data["password"]);

        return $this->userRepository
            ->create($data);
    }
}