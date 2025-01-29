<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryCreateResource;
use App\Services\Category\CreateCategoryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __construct(protected CreateCategoryService $categoryService)
    {
    }

    public function __invoke(StoreCategoryRequest $request): CategoryCreateResource|JsonResponse
    {
        try {
            $category = $this->categoryService
                ->create($request->validated());

            return $this->successResponse(
                message: "Category created successfully",
                status: Response::HTTP_CREATED,
                data: CategoryCreateResource::make($category)
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
