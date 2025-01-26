<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\Category\CreateCategoryService;

class StoreController extends Controller
{
    public function __construct(protected CreateCategoryService $categoryService)
    {
    }

    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $category = $this->categoryService
            ->create($request->validated());

        return CategoryResource::make($category);
    }

}
