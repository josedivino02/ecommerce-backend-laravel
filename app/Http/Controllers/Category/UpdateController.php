<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //Alterar isso aqui, para gravar de forma correta
        $category->name        = $request->name;
        $category->description = $request->has('description') ?? $request->description;
        $category->status      = $request->has('status') ?? $request->status;
        $category->save();

        return response()->json([
            "success" => "The Category successfully updated",
        ], Response::HTTP_OK);
    }
}
