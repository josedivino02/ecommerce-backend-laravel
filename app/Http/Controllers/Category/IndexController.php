<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryIndexResource;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::query()
            ->with("subCategories")
            ->filter($request->all())
            ->paginate(10);

        return CategoryIndexResource::collection($category);
    }
}
