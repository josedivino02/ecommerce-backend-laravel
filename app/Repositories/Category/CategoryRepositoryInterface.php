<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function create(array $data): Category;
    public function listPaginated(?array $params, ?int $perPage): LengthAwarePaginator;
    public function update(Category $category, array $data): Category;
    public function delete(Category $category): bool;
}
