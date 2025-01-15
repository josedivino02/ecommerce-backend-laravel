<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\ValidCategoryForDelete;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DeleteCategoryRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            "category" => $this->route()->category,
        ]);
    }

    public function authorize(): bool
    {
        return Gate::allows("delete", Category::class);
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
            "category" => ["required", new ValidCategoryForDelete()],
        ];
    }
}
