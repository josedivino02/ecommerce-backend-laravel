<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Models\Product;
use App\Services\Product\DeleteProductService;

class DeleteController extends Controller
{
    public function __construct(protected DeleteProductService $productService)
    {
    }

    public function delete(DeleteProductRequest $request, Product $product)
    {
        $this->productService->delete($product);

        return response()->noContent();
    }
}