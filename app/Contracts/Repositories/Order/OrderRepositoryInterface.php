<?php

namespace App\Contracts\Repositories\Order;

use App\Models\{Order, OrderItem};

interface OrderRepositoryInterface
{
    public function create(array $data): Order;
    public function addItems(Order $order, array $data): OrderItem;
    public function cancelOrder(Order $order, array $data): bool;
    public function cancelItemsFromOrder(Order $order, array $data): bool;
    public function updateTotalPrice(Order $order, float $price): bool;
}