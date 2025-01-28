<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use App\Rules\SubCategoryExists;
use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreProductRequest extends FormRequest
{
    use FailValidate;

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
            "category"    => ["required", "integer", new SubCategoryExists()],
        ];
    }

    public function messages(): array
    {
        return [
            "sku.unique" => "The SKU entered is already registered in the system.",
        ];
    }

}