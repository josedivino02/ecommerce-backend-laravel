<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductCreateResource;
use App\Services\Product\CreateProductService;

class StoreController extends Controller
{
    public function __construct(protected CreateProductService $productService)
    {
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());

        return ProductCreateResource::make($product);

    }
}