<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data): Product
    {
        return user()->products()->create($data);
    }

    public function listPaginated(?array $params = [], ?int $perPage = 10): LengthAwarePaginator
    {
        return Product::query()
            ->status()
            ->with("category")
            ->filter($params)
            ->paginate($perPage);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);

        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
