<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductIndexResource;
use App\Services\Product\ListPaginatedProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function __construct(protected ListPaginatedProductService $productService)
    {
    }

    public function __invoke(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $product = $this->productService
                ->listPaginated($request->all());

            return $this->successResponse(
                status: Response::HTTP_OK,
                data: ProductIndexResource::collection($product)
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
