<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCategoryRequest;
use App\Models\Category;

class DeleteController extends Controller
{
    public function delete(DeleteCategoryRequest $request, Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
