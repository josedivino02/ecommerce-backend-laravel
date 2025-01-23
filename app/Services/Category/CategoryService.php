<?php

namespace App\Services\Category;

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
        $data['slug'] = Str::slug($data['name']);

        return $this->categoryRepository->create($data);
    }
}
