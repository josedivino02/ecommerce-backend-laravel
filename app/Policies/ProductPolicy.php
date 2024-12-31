<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    public function isAdmin(User $user): bool
    {
        return user()->isAdmin === 'S';
    }
}
