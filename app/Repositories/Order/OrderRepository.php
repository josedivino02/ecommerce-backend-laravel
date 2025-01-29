<?php

namespace App\Repositories\Order;

use App\Contracts\Repositories\Order\OrderRepositoryInterface;
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

    public function cancelOrder(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    public function cancelItemsFromOrder(Order $order, array $data): bool
    {
        return $order->orderItems()
            ->update($data);
    }

    public function updateTotalPrice(Order $order, float $price): bool
    {
        return $order->update(["total_price" => $price]);
    }
}