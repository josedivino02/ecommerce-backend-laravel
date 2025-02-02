<?php

namespace App\OrderItem\Http\Requests;

use App\OrderItem\Rules\ValidItemForCancellation;
use App\Order\Rules\ValidOrderForCancellation;
use App\Common\Trait\FailValidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CancelOrderItemRequest extends FormRequest
{
    use FailValidate;

    protected function prepareForValidation(): void
    {
        $this->merge([
            "order" => $this->route()->order,
            "item"  => $this->route()->item,
        ]);
    }

    public function authorize(): bool
    {
        $order = $this->route()->order;
        $item  = $this->route()->item;

        return Gate::allows("cancelItem", [$order, $item]);
    }

    public function rules(): array
    {
        return [
            "order" => ["required", new ValidOrderForCancellation()],
            "item"  => ["required", new ValidItemForCancellation()],
        ];
    }
}