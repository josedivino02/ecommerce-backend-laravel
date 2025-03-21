<?php

namespace App\Category\Http\Controllers;

use App\Category\DTOs\UpdateCategoryDTO;
use App\Category\Http\Requests\UpdateCategoryRequest;
use App\Category\Models\Category;
use App\Category\Services\UpdateCategoryService;
use App\Common\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class UpdateController extends Controller
{
    public function __construct(private readonly UpdateCategoryService $categoryService)
    {
    }

    public function __invoke(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        try {
            $categoryDTO = UpdateCategoryDTO::make($request->only([
                "name",
                "description",
                "status",
                "subcategory",
            ]));

            $this->categoryService
                ->update(
                    $category,
                    $categoryDTO
                );

            return $this->successResponse(
                message: "The Category successfully updated",
                status: Response::HTTP_OK
            );
        } catch (\Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
