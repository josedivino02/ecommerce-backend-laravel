<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class UpdateCategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
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
}
