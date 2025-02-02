<?php

namespace App\Auth\Repositories;

use App\Auth\Contracts\Repositories\UserRepositoryInterface;
use App\Auth\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }
}