<?php

namespace App\Services\Item;

use App\Enums\OrderItemsStatus;
use App\Models\{Order, OrderItem};
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\Order\{OrderRepositoryInterface};

class CancelItemService
{
    public function __construct(
        protected ItemRepositoryInterface $itemRepository,
        protected OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function cancel(Order $order, OrderItem $item): bool
    {
        $data = [
            "status" => OrderItemsStatus::CANCELED,
        ];

        $canceledItem = $this->itemRepository->cancel($item, $data);

        $updatedPrice = $order->total_price - $item->total_price;

        $currentPrice = $this->orderRepository->updateTotalPrice($order, $updatedPrice);

        return $canceledItem && $currentPrice;
    }
}
