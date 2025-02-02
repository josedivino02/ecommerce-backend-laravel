<?php

namespace App\Order\Services;

use App\Order\Contracts\Repositories\OrderRepositoryInterface;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListPaginatedOrderService
{
    public function __construct(protected OrderRepositoryInterface $orderRepository)
    {
    }

    public function listPaginated(array $params = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->orderRepository->listPaginated(
            $params,
            $perPage
        );
    }
}
