<?php

namespace App\Product\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Product\Http\Resources\ProductIndexResource;
use App\Product\Services\ListPaginatedProductService;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

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

            return ProductIndexResource::collection($product);
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
