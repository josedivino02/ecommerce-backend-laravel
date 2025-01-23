<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    private Category $category;

    public function create(array $data): Category
    {
        return $this->category::create($data);
    }

    public function listPaginated(?array $params = [], ?int $perPage = 10): Category
    {
        return $this->category::query()
            ->status()
            ->with("subCategories")
            ->filter($params)
            ->paginate($perPage);
    }
}
