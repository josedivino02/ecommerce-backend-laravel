<?php

namespace App\Category\Http\Controllers;

use App\Category\Http\Requests\DeleteCategoryRequest;
use App\Category\Models\Category;
use App\Category\Services\DeleteCategoryService;
use App\Common\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class DeleteController extends Controller
{
    public function __construct(private readonly DeleteCategoryService $categoryService)
    {
    }

    public function __invoke(DeleteCategoryRequest $request, Category $category): JsonResponse
    {
        try {
            $this->categoryService
                ->delete($category);

            return $this->successResponse(
                status: Response::HTTP_NO_CONTENT
            );
        } catch (\Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
