<?php

namespace App\Category\Services;

use App\Category\Contracts\Repositories\CategoryRepositoryInterface;
use App\Category\DTOs\UpdateCategoryDTO;
use App\Category\Models\Category;
use Illuminate\Support\Str;

class UpdateCategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function update(Category $category, UpdateCategoryDTO $data): Category
    {
        if (isset($data->name)) {
            $data->slug = Str::slug($data->name);
        }

        $filteredData = array_filter(
            $data->toArray(),
            fn ($value): bool => !is_null($value)
        );

        return $this->categoryRepository
            ->update(
                $category,
                $filteredData
            );
    }
}
