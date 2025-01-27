<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Services\Category\ListPaginatedCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __construct(private ListPaginatedCategoryService $categoryService)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $category = $this->categoryService
            ->listPaginated($request->all());

        return CategoryIndexResource::collection($category);
    }
}