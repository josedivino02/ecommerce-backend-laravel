<?php

namespace App\Repositories\Item;

use App\Contracts\Repositories\OrderItem\ItemRepositoryInterface;
use App\Models\{OrderItem};

class ItemRepository implements ItemRepositoryInterface
{
    public function cancel(OrderItem $orderItem, array $data): bool
    {
        return $orderItem->update($data);
    }
}
