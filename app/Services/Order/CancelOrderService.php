<?php

namespace App\Services\Order;

use App\Enums\Order\OrderStatus;
use App\Enums\OrderItem\OrderItemsStatus;
use App\Enums\Payment\PaymentStatus;
use App\Enums\Shipping\ShippingStatus;
use App\Models\Order;
use App\Contracts\Repositories\Order\OrderRepositoryInterface;

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