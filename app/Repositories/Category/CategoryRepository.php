<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function listPaginated(?array $params = [], ?int $perPage = 10): Category
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
