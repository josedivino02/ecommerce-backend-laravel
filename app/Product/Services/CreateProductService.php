<?php

namespace App\Product\Services;

use App\Product\Contracts\Repositories\ProductRepositoryInterface;
use App\Product\DTOs\CreateProductDTO;
use App\Product\Enums\ProductStatus;
use App\Product\Models\Product;
use Illuminate\Support\Str;

class CreateProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function create(CreateProductDTO $data): Product
    {
        $data->uuid   = Str::uuid();
        $data->status = ProductStatus::ACTIVE;

        return $this->productRepository
            ->create($data);
    }
}
