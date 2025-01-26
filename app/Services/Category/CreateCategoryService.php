<?php

namespace App\Services\Category;

use App\Enums\CategoryStatus;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CreateCategoryService
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
}
