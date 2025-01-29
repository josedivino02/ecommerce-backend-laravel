<?php

namespace App\Http\Requests\Product;

use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DeleteProductRequest extends FormRequest
{
    use FailValidate;

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

    public function rules(): array
    {
        return [
            "product" => ["required"],
        ];
    }
}