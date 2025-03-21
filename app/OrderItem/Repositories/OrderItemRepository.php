<?php

namespace App\OrderItem\Repositories;

use App\OrderItem\Contracts\Repositories\OrderItemRepositoryInterface;
use App\OrderItem\Models\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    /**
     * Cancel an order item by updating its data.
     *
     * @param array<string, mixed> $data
     */
    public function cancel(OrderItem $orderItem, array $data): bool
    {
        return $orderItem->update($data);
    }
}
