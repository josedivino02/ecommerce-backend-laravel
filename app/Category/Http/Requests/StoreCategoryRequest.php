<?php

namespace App\Category\Http\Requests;

use App\Category\Models\Category;
use App\Category\Rules\SubCategoryExists;
use App\Common\Trait\FailValidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCategoryRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return Gate::allows("create", Category::class);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "name"        => ["required", "string", "unique:categories,name", "min:1", "max:255"],
            "description" => ["required", "string", "min:1"],
            "subcategory" => ["nullable", "integer", new SubCategoryExists()],
        ];
    }
}
