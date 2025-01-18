<?php

namespace App\Policies;

use App\Models\{Product, User};

class ProductPolicy
{
    public function isAdmin(): bool
    {
        return user()->isAdmin === 'S';
    }

    public function update(User $user, Product $product)
    {
        return auth()->check()
            && $this->isAdmin()
            && $this->ownedBy($user, $product);
    }

    public function delete(User $user, Product $product)
    {
        return auth()->check()
            && $this->isAdmin()
            && $this->ownedBy($user, $product);
    }

    public function ownedBy(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }
}
