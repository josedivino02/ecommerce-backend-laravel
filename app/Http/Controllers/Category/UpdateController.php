<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService
            ->update(
                $category,
                $request->only([
                    "name",
                    "description",
                    "status",
                ])
            );

        return response()->json([
            "success" => "The Category successfully updated",
        ], Response::HTTP_OK);
    }
}
