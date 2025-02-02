<?php

namespace App\Category\Http\Controllers;

use App\Category\DTOs\CreateCategoryDTO;
use App\Common\Http\Controllers\Controller;
use App\Category\Http\Requests\StoreCategoryRequest;
use App\Category\Http\Resources\CategoryCreateResource;
use App\Category\Services\CreateCategoryService;

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
            $categoryDTO = CreateCategoryDTO::make($request->validated());

            $category = $this->categoryService
                ->create($categoryDTO);

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