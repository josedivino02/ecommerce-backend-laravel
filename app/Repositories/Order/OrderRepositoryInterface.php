<?php

namespace App\Repositories\Order;

use App\Models\{Order, OrderItem};

interface OrderRepositoryInterface
{
    public function create(array $data): Order;
    public function addItems(Order $order, array $data): OrderItem;
}
