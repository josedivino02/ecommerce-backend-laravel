<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\Product\UpdateProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __construct(protected UpdateProductService $productService)
    {
    }

    public function __invoke(UpdateProductRequest $request, Product $product): JsonResponse
    {
        try {
            $this->productService->update(
                $product,
                $request->only(
                    [
                        "name",
                        "description",
                        "price",
                        "stock",
                        "sku",
                        "image_url",
                        "status",
                        "category_id",
                    ]
                )
            );

            return $this->successResponse(
                message: "The product successfully updated",
                status: Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}