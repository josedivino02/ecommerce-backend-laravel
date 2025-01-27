<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryCreateResource;
use App\Services\Category\CreateCategoryService;

class StoreController extends Controller
{
    public function __construct(protected CreateCategoryService $categoryService)
    {
    }

    public function store(StoreCategoryRequest $request): CategoryCreateResource
    {
        $category = $this->categoryService
            ->create($request->validated());

        return CategoryCreateResource::make($category);
    }

}