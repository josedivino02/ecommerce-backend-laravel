<?php

namespace App\OrderItem\Contracts\Repositories;

use App\OrderItem\Models\OrderItem;

interface OrderItemRepositoryInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function cancel(OrderItem $orderItem, array $data): bool;
}
