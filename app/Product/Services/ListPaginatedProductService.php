<?php

namespace App\Product\Services;

use App\Product\Contracts\Repositories\ProductRepositoryInterface;

use App\Product\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListPaginatedProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @param array<string, mixed> $params
     * @return LengthAwarePaginator<Product>
     */
    public function listPaginated(array $params = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->productRepository->listPaginated(
            $params,
            $perPage
        );
    }
}
