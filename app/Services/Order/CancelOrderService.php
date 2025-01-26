<?php

namespace App\Services\Order;

use App\Enums\{OrderItemsStatus, OrderStatus, PaymentStatus, ShippingStatus};
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;

class CancelOrderService
{
    public function __construct(protected OrderRepositoryInterface $orderRepository)
    {
    }

    public function cancel(Order $order)
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
