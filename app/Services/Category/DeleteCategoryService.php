<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Contracts\Repositories\Category\CategoryRepositoryInterface;

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