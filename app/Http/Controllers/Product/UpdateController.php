<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update(
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

        return response()->json([
            "success" => "The product successfully updated",
        ], Response::HTTP_OK);
    }
}
