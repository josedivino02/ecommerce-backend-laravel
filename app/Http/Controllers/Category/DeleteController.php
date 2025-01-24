<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;

class DeleteController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function delete(DeleteCategoryRequest $request, Category $category)
    {
        $this->categoryService->delete($category);

        return response()->noContent();
    }
}
