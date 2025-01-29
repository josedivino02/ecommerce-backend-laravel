<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductCreateResource;
use App\Services\Product\CreateProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __construct(protected CreateProductService $productService)
    {
    }

    public function __invoke(StoreProductRequest $request): ProductCreateResource|JsonResponse
    {
        try {
            $product = $this->productService
                ->create($request->validated());

            return $this->successResponse(
                message: "Product created successfully",
                status: Response::HTTP_CREATED,
                data:ProductCreateResource::make($product)
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}