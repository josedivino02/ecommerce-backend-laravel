<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\CreateProductService;

class StoreController extends Controller
{
    public function __construct(protected CreateProductService $productService)
    {
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());

        return ProductResource::make($product);

    }
}
