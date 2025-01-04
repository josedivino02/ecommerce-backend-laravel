<?php

namespace App\Policies;

use App\Models\{Order, OrderItem, User};

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

    public function cancelItem(User $user, Order $order, OrderItem $item): bool
    {
        return $user->id === $order->user_id && $order->id === $item->order_id;
    }
}
