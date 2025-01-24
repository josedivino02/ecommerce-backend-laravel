<?php

namespace App\Services\Category;

use App\Enums\CategoryStatus;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function create(array $data): Category
    {
        $data["uuid"]   = Str::uuid();
        $data["slug"]   = Str::slug($data["name"]);
        $data["status"] = CategoryStatus::ACTIVE;

        if (isset($data["subcategory"])) {
            $data['sub'] = $data['subcategory'];
            unset($data['subcategory']);
        }

        return $this->categoryRepository
            ->create($data);
    }

    public function listPaginated(array $params = [], int $perPage = 10): Category
    {
        return $this->categoryRepository
            ->listPaginated(
                $params,
                $perPage
            );
    }

    public function update(Category $category, array $data): Category
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if (isset($data["subcategory"])) {
            $data['sub'] = $data['subcategory'];
            unset($data['subcategory']);
        }

        return $this->categoryRepository
            ->update(
                $category,
                $data
            );
    }

    public function delete(Category $category): bool
    {
        return $this->categoryRepository->delete($category);
    }
}
