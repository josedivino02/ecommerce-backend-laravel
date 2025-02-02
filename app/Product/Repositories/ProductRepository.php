<?php

namespace App\Product\Repositories;

use App\Product\Contracts\Repositories\ProductRepositoryInterface;
use App\Product\DTOs\CreateProductDTO;
use App\Product\Models\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(CreateProductDTO $data): Product
    {
        return Product::create($data->toArray());
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