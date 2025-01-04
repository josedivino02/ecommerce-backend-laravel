<?php

namespace App\Policies;

use App\Models\{Order, User};

class OrderPolicy
{
    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function cancel(User $user, Order $order): bool
    {
        return $user->id === $order->user_id;
    }
}
