<?php

namespace App\Category\Policies;

use App\Auth\Models\{User};

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

    public function delete(User $user): bool
    {
        return auth()->check() && $this->isAdmin();
    }
}