<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryIndexResource;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::query()
            ->with("subCategories")
            ->filter($request->all())
            ->paginate();

        return CategoryIndexResource::collection($category);
    }
}
