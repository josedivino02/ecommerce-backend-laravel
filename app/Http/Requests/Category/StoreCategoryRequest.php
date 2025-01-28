<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Rules\Category\SubCategoryExists;
use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCategoryRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return Gate::allows("create", Category::class);
    }

    public function rules(): array
    {
        return [
            "name"        => ["required", "string", "unique:categories,name", "min:1", "max:255"],
            "description" => ["required", "string", "min:1"],
            "subcategory" => ["nullable", "integer", new SubCategoryExists()],
        ];
    }
}