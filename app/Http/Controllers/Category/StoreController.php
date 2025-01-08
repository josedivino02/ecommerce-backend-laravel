<?php

namespace App\Http\Controllers\Category;

use App\Enums\CategoryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreCategoryRequest};
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            "uuid"        => Str::uuid(),
            "name"        => $request->name,
            "slug"        => Str::slug($request->name),
            "sub"         => $request->subcategory,
            "description" => $request->description,
            "status"      => CategoryStatus::ACTIVE,
        ]);

        return CategoryResource::make($category);
    }

}
