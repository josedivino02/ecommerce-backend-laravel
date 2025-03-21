<?php

namespace App\Auth\Repositories;

use App\Auth\Contracts\Repositories\UserRepositoryInterface;
use App\Auth\Models\User;

/**
 * @implements UserRepositoryInterface
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): User
    {
        return User::create($data);
    }
}
