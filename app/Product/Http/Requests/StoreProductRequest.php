<?php

namespace App\Product\Http\Requests;

use App\Category\Rules\SubCategoryExists;
use App\Common\Trait\FailValidate;
use App\Product\Models\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreProductRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return Gate::allows("isAdmin", Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "name"        => ["required", "max:255"],
            "description" => ["required"],
            "price"       => ["required", "numeric", "regex:/^\d+(\.\d{1,2})?$/", "min:0.01"],
            "stock"       => ["required", "numeric", "integer", "min:0"],
            "sku"         => ["required", "unique:products,sku", "max:50"],
            "image_url"   => ["required", "string"],
            "category"    => ["required", "integer", new SubCategoryExists()],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "sku.unique" => "The SKU entered is already registered in the system.",
        ];
    }

}
