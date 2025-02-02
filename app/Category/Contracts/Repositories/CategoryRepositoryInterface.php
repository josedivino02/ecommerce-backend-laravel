<?php

namespace App\Category\Contracts\Repositories;

use App\Category\DTOs\CreateCategoryDTO;
use App\Category\Models\Category;

use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function create(CreateCategoryDTO $data): Category;
    public function listPaginated(?array $params, ?int $perPage): LengthAwarePaginator;
    public function update(Category $category, array $data): Category;
    public function delete(Category $category): bool;
}