<?php

namespace App\Category\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Category\Http\Requests\DeleteCategoryRequest;
use App\Category\Models\Category;
use App\Category\Services\DeleteCategoryService;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    public function __construct(private DeleteCategoryService $categoryService)
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
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}