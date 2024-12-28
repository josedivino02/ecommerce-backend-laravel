<?php

namespace App\Policies;

use App\Models\{User};

class OrderPolicy
{
    public function create(User $user): bool
    {
        return auth()->check();
    }
}
