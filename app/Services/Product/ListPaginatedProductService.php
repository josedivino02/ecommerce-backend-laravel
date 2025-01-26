<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListPaginatedProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function listPaginated(array $params = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->productRepository->listPaginated(
            $params,
            $perPage
        );
    }
}
