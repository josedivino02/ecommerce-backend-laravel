<?php

namespace App\Category\Repositories;

use App\Category\Contracts\Repositories\CategoryRepositoryInterface;
use App\Category\DTOs\CreateCategoryDTO;
use App\Category\Models\Category;

use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(CreateCategoryDTO $data): Category
    {
        return Category::create($data->toArray());
    }

    public function listPaginated(?array $params = [], ?int $perPage = 10): LengthAwarePaginator
    {
        return Category::query()
            ->status()
            ->with("subCategories")
            ->filter($params)
            ->paginate($perPage);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);

        return $category;
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}