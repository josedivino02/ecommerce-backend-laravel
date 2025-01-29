<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Models\Product;
use App\Services\Product\DeleteProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    public function __construct(protected DeleteProductService $productService)
    {
    }

    public function __invoke(DeleteProductRequest $request, Product $product): JsonResponse
    {
        try {
            $this->productService
                ->delete($product);

            return $this->successResponse(
                status: Response::HTTP_NO_CONTENT
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}