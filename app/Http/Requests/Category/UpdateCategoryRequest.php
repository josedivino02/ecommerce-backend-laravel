<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Rules\{SubCategoryExists, ValidCategoryForUpdated, ValidCategoryHierarchy, ValidCategoryStatus};
use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCategoryRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "category" => $this->route()->category,
        ]);
    }

    public function authorize(): bool
    {
        return Gate::allows("update", Category::class);
    }

    public function rules(): array
    {
        return [
            "category"    => ["required", new ValidCategoryForUpdated($this->input("status"))],
            "name"        => ["nullable", "string", "unique:categories,name", "min:1", "max:255"],
            "description" => ["nullable", "string", "min:1"],
            "status"      => ["nullable", new ValidCategoryStatus()],
            "subcategory" => ["nullable", "integer", new SubCategoryExists(), new ValidCategoryHierarchy($this->route()->category)],
        ];
    }

    public function messages(): array
    {
        return [
            "name.unique" => "The Category name entered is already registered in the system.",
        ];
    }
}