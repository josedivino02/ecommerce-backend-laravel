<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class UpdateProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function update(Product $product, array $data): Product
    {
        if (isset($data["category"])) {
            $data['category_id'] = $data['category'];
            unset($data['category']);
        }

        return $this->productRepository
            ->update(
                $product,
                $data
            );
    }
}
