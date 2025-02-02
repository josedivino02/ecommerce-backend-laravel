<?php

namespace App\Auth\Contracts\Repositories;

use App\Auth\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
}