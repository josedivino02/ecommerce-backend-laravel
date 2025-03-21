<?php

namespace App\Product\Http\Requests;

use App\Common\Trait\FailValidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DeleteProductRequest extends FormRequest
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

        return Gate::allows("delete", $product);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "product" => ["required"],
        ];
    }
}
