<?php

namespace App\Services\Product;

use App\Models\{Product};
use App\Contracts\Repositories\Product\ProductRepositoryInterface;

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