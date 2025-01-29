<?php

namespace App\Contracts\Repositories\OrderItem;

use App\Models\{OrderItem};

interface ItemRepositoryInterface
{
    public function cancel(OrderItem $orderItem, array $data): bool;
}
