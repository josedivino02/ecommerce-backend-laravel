<?php

namespace App\Order\Services;

use App\Order\Contracts\Repositories\OrderRepositoryInterface;
use App\Order\DTOs\CreateOrderDTO;
use App\Order\Enums\{OrderStatus, PaymentStatus, ShippingStatus};
use App\Order\Models\Order;
use App\OrderItem\Enums\OrderItemsStatus;

use Illuminate\Support\Str;

class CreateOrderService
{
    public function __construct(protected OrderRepositoryInterface $orderRepository)
    {
    }

    public function create(CreateOrderDTO $data): Order
    {
        $totalPrice = $this->calculateTotalPrice(
            $data->items,
            $data->discount
        );

        $data->uuid              = Str::uuid();
        $data->total_price       = $totalPrice;
        $data->payment_status    = PaymentStatus::PENDING;
        $data->shipping_status   = ShippingStatus::PROCESSING;
        $data->status            = OrderStatus::PENDING;
        $data->verification_code = strtoupper(Str::random(10));

        $items = $data->items;

        $order = $this->orderRepository
            ->create($data);

        $this->addItems(
            $order,
            $items
        );

        return $order;
    }

    /**
     * @param array<int, array<string, mixed>> $items
     */
    private function addItems(Order $order, array $items): void
    {
        collect($items)->each(function (array $item) use ($order): void {
            $item["uuid"]        = Str::uuid();
            $item["total_price"] = $item["unit_price"] * $item["quantity"];
            $item["tracking"]    = now()->timestamp . random_int(100, 999);
            $item["status"]      = OrderItemsStatus::PENDING;

            $this->orderRepository->addItems($order, $item);
        });
    }

    /**
     * @param array<int, array<string, mixed>> $items
     */
    private function calculateTotalPrice(array $items, float $discount): float
    {
        $totalPrice = collect($items)->reduce(
            fn ($acc, array $item): float|int => $acc + ($item['unit_price'] * $item['quantity']),
            0
        );

        return $totalPrice - $discount;
    }
}
