<?php

namespace App\Repositories\Item;

use App\Models\{OrderItem};

interface ItemRepositoryInterface
{
    public function cancel(OrderItem $orderItem, array $data): bool;
}
