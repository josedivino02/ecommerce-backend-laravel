<?php

namespace App\Http\Controllers\Product;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;

class StoreController extends Controller
{
    public function store(StoreProductRequest $request)
    {
        $product = user()->products()
            ->create([
                "name"        => $request->name,
                "description" => $request->description,
                "price"       => $request->price,
                "stock"       => $request->stock,
                "sku"         => $request->sku,
                "image_url"   => $request->image_url,
                "status"      => ProductStatus::ACTIVE,
            ]);

        return ProductResource::make($product);

    }
}
