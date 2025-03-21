<?php

namespace App\Category\Services;

use App\Category\Contracts\Repositories\CategoryRepositoryInterface;
use App\Category\DTOs\CreateCategoryDTO;
use App\Category\Enums\CategoryStatus;
use App\Category\Models\Category;

use Illuminate\Support\Str;

class CreateCategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function create(CreateCategoryDTO $data): Category
    {
        $data->uuid   = Str::uuid();
        $data->slug   = Str::slug($data->name);
        $data->status = CategoryStatus::ACTIVE;

        return $this->categoryRepository
            ->create($data);
    }
}
