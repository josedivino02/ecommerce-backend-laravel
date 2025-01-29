<?php

namespace App\Contracts\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
}