<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductIndexResource;
use App\Services\Product\ListPaginatedProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __construct(protected ListPaginatedProductService $productService)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $product = $this->productService
            ->listPaginated($request->all());

        return ProductIndexResource::collection($product);
    }
}