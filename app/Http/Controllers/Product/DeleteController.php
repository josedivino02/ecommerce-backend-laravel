<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteProductRequest;
use App\Models\Product;

class DeleteController extends Controller
{
    public function delete(DeleteProductRequest $request, Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
