<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DeleteProductRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            "product" => $this->route()->product,
        ]);
    }

    public function authorize(): bool
    {
        $product = $this->route()->product;

        return Gate::allows("delete", $product);
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
            "product" => ["required"],
        ];
    }
}
