<?php

namespace App\Category\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Category\Http\Resources\CategoryIndexResource;
use App\Category\Services\ListPaginatedCategoryService;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function __construct(private ListPaginatedCategoryService $categoryService)
    {
    }

    public function __invoke(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $category = $this->categoryService
                ->listPaginated($request->all());

            return $this->successResponse(
                status: Response::HTTP_OK,
                data: CategoryIndexResource::collection($category)
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}