<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreCategoryRequest};
use App\Http\Resources\CategoryResource;
use App\Services\Category\CategoryService;

class StoreController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $category = $this->categoryService
            ->create($request->validated());

        return CategoryResource::make($category);
    }

}
