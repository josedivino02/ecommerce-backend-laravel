<?php

namespace App\Order\Contracts\Repositories;

use App\Order\DTOs\CreateOrderDTO;
use App\Order\Models\Order;
use App\OrderItem\Models\OrderItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function create(CreateOrderDTO $data): Order;
    public function addItems(Order $order, array $data): OrderItem;
    public function cancelOrder(Order $order, array $data): bool;
    public function cancelItemsFromOrder(Order $order, array $data): bool;
    public function updateTotalPrice(Order $order, float $price): bool;
    public function listPaginated(?array $params, ?int $perPage): LengthAwarePaginator;
}
