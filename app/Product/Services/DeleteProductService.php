<?php

namespace App\Product\Services;

use App\Product\Contracts\Repositories\ProductRepositoryInterface;
use App\Product\Models\{Product};

class DeleteProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function delete(Product $product): bool
    {
        return $this->productRepository->delete($product);
    }
}
