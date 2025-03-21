<?php

namespace App\OrderItem\Services;

use App\Order\Contracts\Repositories\OrderRepositoryInterface;
use App\Order\Models\Order;
use App\OrderItem\Contracts\Repositories\OrderItemRepositoryInterface;
use App\OrderItem\Enums\OrderItemsStatus;
use App\OrderItem\Models\OrderItem;

class CancelItemService
{
    public function __construct(
        protected OrderItemRepositoryInterface $itemRepository,
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
