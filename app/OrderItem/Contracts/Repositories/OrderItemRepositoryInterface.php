<?php

namespace App\OrderItem\Contracts\Repositories;

use App\OrderItem\Models\OrderItem;

interface OrderItemRepositoryInterface
{
    public function cancel(OrderItem $orderItem, array $data): bool;
}