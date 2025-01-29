<?php

namespace App\Repositories\User;

use App\Contracts\Repositories\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }
}