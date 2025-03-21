<?php

namespace App\Order\Services;

use App\Order\Contracts\Repositories\OrderRepositoryInterface;
use App\Order\Enums\{OrderStatus, PaymentStatus, ShippingStatus};
use App\Order\Models\Order;
use App\OrderItem\Enums\OrderItemsStatus;

class CancelOrderService
{
    public function __construct(protected OrderRepositoryInterface $orderRepository)
    {
    }

    public function cancel(Order $order): bool
    {
        $data = [
            "status"          => OrderStatus::CANCELED,
            "payment_status"  => PaymentStatus::CANCELED,
            "shipping_status" => ShippingStatus::CANCELED,
        ];

        $orderCanceled = $this->orderRepository->cancelOrder($order, $data);

        $data = [
            "status" => OrderItemsStatus::CANCELED,
        ];

        $orderItemsCanceled = $this->orderRepository->cancelItemsFromOrder($order, $data);

        return $orderCanceled && $orderItemsCanceled;
    }
}
