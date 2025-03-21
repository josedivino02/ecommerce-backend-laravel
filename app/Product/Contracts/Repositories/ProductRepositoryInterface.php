<?php

namespace App\Product\Contracts\Repositories;

use App\Product\DTOs\CreateProductDTO;
use App\Product\Models\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Create a new product.
     */
    public function create(CreateProductDTO $data): Product;

    /**
     * Get paginated list of products.
     *
     * @param array<string, mixed>|null $params
     * @return LengthAwarePaginator<Product>
     */
    public function listPaginated(?array $params, ?int $perPage): LengthAwarePaginator;

    /**
     * Update a product.
     *
     * @param array<string, mixed> $data
     */
    public function update(Product $product, array $data): Product;

    /**
     * Delete a product.
     */
    public function delete(Product $product): bool;
}
