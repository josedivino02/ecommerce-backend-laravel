<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\SubCategoryExists;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows("create", Category::class);
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
            "name"        => ["required", "string", "unique:categories,name", "min:1", "max:255"],
            "description" => ["required", "string", "min:1"],
            "subcategory" => ["nullable", new SubCategoryExists()],
        ];
    }
}
