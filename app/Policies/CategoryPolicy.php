<?php

namespace App\Policies;

use App\Models\{User};

class CategoryPolicy
{
    public function create(User $user): bool
    {
        return auth()->check() && $this->isAdmin();
    }

    public function isAdmin(): bool
    {
        return user()->isAdmin === 'S';
    }

    public function update(User $user): bool
    {
        return auth()->check() && $this->isAdmin();
    }
}
