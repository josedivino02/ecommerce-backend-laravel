<?php

namespace App\Http\Controllers\Product;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function store(StoreProductRequest $request)
    {
        $product = user()->products()
            ->create([
                "uuid"        => Str::uuid(),
                "name"        => $request->name,
                "description" => $request->description,
                "price"       => $request->price,
                "stock"       => $request->stock,
                "sku"         => $request->sku,
                "image_url"   => $request->image_url,
                "category_id" => $request->category,
                "status"      => ProductStatus::ACTIVE,
            ]);

        return ProductResource::make($product);

    }
}
