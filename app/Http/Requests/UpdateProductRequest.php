<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\{CategoryExists, ValidProductForUpdated, ValidProductStatus};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            "product" => $this->route()->product,
        ]);
    }

    public function authorize(): bool
    {
        return Gate::allows("update", Product::class);
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
            "product"     => ["required", new ValidProductForUpdated($this->input("status"))],
            "name"        => ["nullable", "string", "unique:products,name", "min:1", "max:255"],
            "description" => ["nullable", "string", "min:1", "max:10000"],
            "price"       => ["nullable", "numeric", "decimal:2", "min:0.01"],
            "stock"       => ["nullable", "numeric", "integer", "min:0"],
            "sku"         => ["nullable", "unique:products,sku", "max:50"],
            "image_url"   => ["nullable", "url"],
            "status"      => ["nullable", new ValidProductStatus()],
            "category_id" => ["nullable", "integer", new CategoryExists()],
        ];
    }

    public function messages(): array
    {
        return [
            "name.unique" => "The Product name entered is already registered in the system.",
            "sku.unique"  => "The SKU entered is already registered in the system.",
        ];
    }
}
