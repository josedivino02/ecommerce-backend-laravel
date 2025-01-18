<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductIndexResource;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::query()
            ->status()
            ->with("category")
            ->filter($request->all())
            ->paginate(10);

        return ProductIndexResource::collection($product);
    }
}
