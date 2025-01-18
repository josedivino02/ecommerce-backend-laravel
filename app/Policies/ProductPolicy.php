<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    public function isAdmin(): bool
    {
        return user()->isAdmin === 'S';
    }

    public function update(User $user)
    {
        return auth()->check() && $this->isAdmin();
    }
}
