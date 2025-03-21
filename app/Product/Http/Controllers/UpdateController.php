<?php

namespace App\Product\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Product\DTOs\UpdateProductDTO;
use App\Product\Http\Requests\UpdateProductRequest;
use App\Product\Models\Product;
use App\Product\Services\UpdateProductService;

use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class UpdateController extends Controller
{
    public function __construct(protected UpdateProductService $productService)
    {
    }

    public function __invoke(UpdateProductRequest $request, Product $product): JsonResponse
    {
        try {
            $productDTO = UpdateProductDTO::make(
                $request->only([
                    "name",
                    "description",
                    "price",
                    "stock",
                    "sku",
                    "image_url",
                    "status",
                    "category_id",
                ])
            );

            $this->productService->update(
                $product,
                $productDTO
            );

            return $this->successResponse(
                message: "The product successfully updated",
                status: Response::HTTP_OK
            );
        } catch (\Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
