<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Category\UpdateCategoryService;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __construct(private UpdateCategoryService $categoryService)
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
                    "subcategory",
                ])
            );

        return response()->json([
            "success" => "The Category successfully updated",
        ], Response::HTTP_OK);
    }
}
