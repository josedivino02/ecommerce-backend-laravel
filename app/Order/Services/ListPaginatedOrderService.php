<?php

namespace App\Order\Services;

use App\Order\Contracts\Repositories\OrderRepositoryInterface;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListPaginatedOrderService
{
    public function __construct(protected OrderRepositoryInterface $orderRepository)
    {
    }

    /**
     * @param array<string, mixed> $params
     * @return LengthAwarePaginator<array<string, mixed>>
     */
    public function listPaginated(array $params = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->orderRepository->listPaginated(
            $params,
            $perPage
        );
    }
}
