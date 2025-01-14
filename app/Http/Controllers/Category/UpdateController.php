<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update(array_merge(
            $request->only(["name", "description", "status"]),
            ["slug" => Str::slug($request->name)]
        ));

        return response()->json([
            "success" => "The Category successfully updated",
        ], Response::HTTP_OK);
    }
}
