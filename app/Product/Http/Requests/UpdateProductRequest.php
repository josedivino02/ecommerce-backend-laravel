<?php

namespace App\Product\Http\Requests;

use App\Category\Rules\CategoryExists;
use App\Common\Trait\FailValidate;
use App\Product\Rules\{ValidProductForUpdated, ValidProductStatus};

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateProductRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "product" => $this->route('product'),
        ]);
    }

    public function authorize(): bool
    {
        $product = $this->route('product');

        return Gate::allows("update", $product);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
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

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "name.unique" => "The Product name entered is already registered in the system.",
            "sku.unique"  => "The SKU entered is already registered in the system.",
        ];
    }
}
