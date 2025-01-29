<?php

namespace App\Services\Product;

use App\Enums\Product\ProductStatus;
use App\Models\Product;
use App\Contracts\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Str;

class CreateProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function create(array $data): Product
    {
        $data["uuid"]   = Str::uuid();
        $data["status"] = ProductStatus::ACTIVE;

        if (isset($data["category"])) {
            $data['category_id'] = $data['category'];
            unset($data['category']);
        }

        return $this->productRepository
            ->create($data);
    }
}
