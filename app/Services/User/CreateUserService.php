<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
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
