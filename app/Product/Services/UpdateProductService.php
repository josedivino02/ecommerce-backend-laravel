<?php

namespace App\Product\Services;

use App\Product\Contracts\Repositories\ProductRepositoryInterface;
use App\Product\DTOs\UpdateProductDTO;
use App\Product\Models\Product;

class UpdateProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function update(Product $product, UpdateProductDTO $data): Product
    {
        $filteredData = array_filter(
            $data->toArray(),
            fn ($value): bool => !is_null($value)
        );

        return $this->productRepository
            ->update(
                $product,
                $filteredData
            );
    }
}
