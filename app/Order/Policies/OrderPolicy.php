<?php

namespace App\Order\Policies;

use App\Auth\Models\User;
use App\Order\Models\Order;
use App\OrderItem\Models\OrderItem;

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