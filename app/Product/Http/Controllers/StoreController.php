<?php

namespace App\Product\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Product\DTOs\CreateProductDTO;
use App\Product\Http\Requests\StoreProductRequest;
use App\Product\Http\Resources\ProductCreateResource;
use App\Product\Services\CreateProductService;

use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class StoreController extends Controller
{
    public function __construct(protected CreateProductService $productService)
    {
    }

    public function __invoke(StoreProductRequest $request): ProductCreateResource|JsonResponse
    {
        try {
            $productDTO = CreateProductDTO::make($request->validated());

            $product = $this->productService
                ->create($productDTO);

            return $this->successResponse(
                message: "Product created successfully",
                status: Response::HTTP_CREATED,
                data:ProductCreateResource::make($product)
            );
        } catch (\Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
