<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\{SubCategoryExists, ValidCategoryForUpdated, ValidCategoryHierarchy, ValidCategoryStatus};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryRequest extends FormRequest
{
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function rules(): array
    {
        return [
            "category"    => ["required", new ValidCategoryForUpdated($this->input("status"))],
            "name"        => ["required", "string", "unique:categories,name", "min:1", "max:255"],
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
