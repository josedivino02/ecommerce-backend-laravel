<?php

namespace App\Order\Repositories;

use App\Order\Contracts\Repositories\OrderRepositoryInterface;
use App\Order\DTOs\CreateOrderDTO;
use App\Order\Models\Order;
use App\OrderItem\Models\OrderItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(CreateOrderDTO $data): Order
    {
        $data = $data->toArray();
        unset($data["items"]);

        return Order::create($data);
    }

    public function addItems(Order $order, array $data): OrderItem
    {
        return $order->orderItems()
            ->create($data);
    }

    public function cancelOrder(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    public function cancelItemsFromOrder(Order $order, array $data): bool
    {
        return $order->orderItems()
            ->update($data);
    }

    public function updateTotalPrice(Order $order, float $price): bool
    {
        return $order->update(["total_price" => $price]);
    }

    public function listPaginated(?array $params = [], ?int $perPage = 10): LengthAwarePaginator
    {
        return Order::query()
            ->status()
            ->with('orderItems')
            ->filter($params)
            ->paginate($perPage);
    }
}
