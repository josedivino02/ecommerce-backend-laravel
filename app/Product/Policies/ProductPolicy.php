<?php

namespace App\Product\Policies;

use App\Auth\Models\User;
use App\Product\Models\Product;

class ProductPolicy
{
    public function isAdmin(): bool
    {
        return user()->isAdmin === 'S';
    }

    public function update(User $user, Product $product): bool
    {
        return auth()->check()
            && $this->isAdmin()
            && $this->ownedBy($user, $product);
    }

    public function delete(User $user, Product $product): bool
    {
        return auth()->check()
            && $this->isAdmin()
            && $this->ownedBy($user, $product);
    }

    public function ownedBy(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }
}
