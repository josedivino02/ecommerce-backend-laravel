<?php

namespace App\Contracts\Repositories\Product;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function create(array $data): Product;
    public function listPaginated(?array $params, ?int $perPage): LengthAwarePaginator;
    public function update(Product $product, array $data): Product;
    public function delete(Product $product): bool;
}