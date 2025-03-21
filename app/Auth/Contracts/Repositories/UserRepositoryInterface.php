<?php

namespace App\Auth\Contracts\Repositories;

use App\Auth\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): User;
}
