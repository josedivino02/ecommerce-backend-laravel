<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\Product\UpdateProductService;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __construct(protected UpdateProductService $productService)
    {
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
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

        return response()->json([
            "success" => "The product successfully updated",
        ], Response::HTTP_OK);
    }
}
