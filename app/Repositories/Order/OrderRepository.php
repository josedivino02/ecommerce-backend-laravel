<?php

namespace App\Repositories\Order;

use App\Models\{Order, OrderItem};

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        return user()->orders()
            ->create($data);
    }

    public function addItems(Order $order, array $data): OrderItem
    {
        return $order->orderItems()
            ->create($data);
    }
}
