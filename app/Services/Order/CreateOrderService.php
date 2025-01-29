<?php

namespace App\Services\Order;

use App\Enums\Order\OrderStatus;
use App\Enums\OrderItem\OrderItemsStatus;
use App\Enums\Payment\PaymentStatus;
use App\Enums\Shipping\ShippingStatus;
use App\Models\Order;
use App\Contracts\Repositories\Order\OrderRepositoryInterface;

use Illuminate\Support\Str;

class CreateOrderService
{
    public function __construct(protected OrderRepositoryInterface $orderRepository)
    {
    }

    public function create(array $data): Order
    {
        $totalPrice = $this->calculateTotalPrice(
            $data["items"],
            $data["discount"]
        );

        $data["uuid"]              = Str::uuid();
        $data["payment_status"]    = PaymentStatus::PENDING;
        $data["shipping_status"]   = ShippingStatus::PROCESSING;
        $data["verification_code"] = strtoupper(Str::random(10));
        $data["status"]            = OrderStatus::PENDING;
        $data["total_price"]       = $totalPrice;

        $items = $data["items"];
        unset($data["items"]);

        $order = $this->orderRepository
            ->create($data);

        $this->addItems(
            $order,
            $items
        );

        return $order;
    }

    private function addItems(Order $order, array $items): void
    {
        collect($items)->each(function ($item) use ($order) {
            $item["uuid"]        = Str::uuid();
            $item["total_price"] = $item["unit_price"] * $item["quantity"];
            $item["tracking"]    = now()->timestamp . rand(100, 999);
            $item["status"]      = OrderItemsStatus::PENDING;

            $this->orderRepository->addItems($order, $item);
        });
    }

    private function calculateTotalPrice(array $items, float $discount): float
    {
        $totalPrice = collect($items)->reduce(
            function ($acc, $item) {
                return $acc + ($item['unit_price'] * $item['quantity']);
            },
            0
        );

        return $totalPrice - $discount;
    }
}
