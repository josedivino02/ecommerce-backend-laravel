<?php

namespace App\Product\Contracts\Repositories;

use App\Product\DTOs\CreateProductDTO;
use App\Product\Models\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function create(CreateProductDTO $data): Product;
    public function listPaginated(?array $params, ?int $perPage): LengthAwarePaginator;
    public function update(Product $product, array $data): Product;
    public function delete(Product $product): bool;
}