<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows("isAdmin", Product::class);
    }

    public function rules(): array
    {
        return [
            "name"        => ["required", "max:255"],
            "description" => ["required"],
            "price"       => ["required", "numeric", "regex:/^\d+(\.\d{1,2})?$/", "min:0.01"],
            "stock"       => ["required", "numeric", "integer", "min:0"],
            "sku"         => ["required", "unique:products,sku", "max:50"],
            "image_url"   => ["nullable", "url"],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function messages(): array
    {
        return [
            "sku.unique" => "The SKU entered is already registered in the system.",
        ];
    }

}
