<?php

namespace App\Http\Requests\Order;

use App\Rules\ValidOrderForCancellation;
use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CancelOrderRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "order" => $this->route()->order,
        ]);
    }

    public function authorize(): bool
    {
        $order = $this->route()->order;

        return $order && Gate::allows("cancel", $order);
    }

    public function rules(): array
    {
        return [
            "order" => ["required", new ValidOrderForCancellation()],
        ];
    }
}