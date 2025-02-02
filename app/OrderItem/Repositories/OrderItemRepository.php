<?php

namespace App\OrderItem\Repositories;

use App\OrderItem\Contracts\Repositories\OrderItemRepositoryInterface;
use App\OrderItem\Models\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function cancel(OrderItem $orderItem, array $data): bool
    {
        return $orderItem->update($data);
    }
}