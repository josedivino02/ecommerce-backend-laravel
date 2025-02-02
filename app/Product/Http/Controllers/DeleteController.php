<?php

namespace App\Product\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Product\Http\Requests\DeleteProductRequest;
use App\Product\Models\Product;
use App\Product\Services\DeleteProductService;

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