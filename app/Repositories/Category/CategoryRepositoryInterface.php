<?php

namespace App\Repositories\Category;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function create(array $data): Category;
    public function listPaginated(?array $params, ?int $perPage): Category;
    public function update(Category $category, array $data): Category;
    public function delete(Category $category): bool;
}
