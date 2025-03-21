<?php

namespace App\Category\Http\Controllers;

use App\Category\Http\Resources\CategoryIndexResource;
use App\Category\Services\ListPaginatedCategoryService;
use App\Common\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class IndexController extends Controller
{
    public function __construct(private readonly ListPaginatedCategoryService $categoryService)
    {
    }

    public function __invoke(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $category = $this->categoryService
                ->listPaginated($request->all());

            return  CategoryIndexResource::collection($category);
        } catch (\Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
