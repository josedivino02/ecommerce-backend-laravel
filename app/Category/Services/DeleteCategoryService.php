<?php

namespace App\Category\Services;

use App\Category\Contracts\Repositories\CategoryRepositoryInterface;
use App\Category\Models\Category;

class DeleteCategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function delete(Category $category): bool
    {
        return $this->categoryRepository->delete($category);
    }
}
