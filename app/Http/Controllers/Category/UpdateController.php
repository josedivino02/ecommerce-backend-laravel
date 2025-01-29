<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Category\UpdateCategoryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __construct(private UpdateCategoryService $categoryService)
    {
    }

    public function __invoke(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        try {
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

            return $this->successResponse(
                message: "The Category successfully updated",
                status: Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}