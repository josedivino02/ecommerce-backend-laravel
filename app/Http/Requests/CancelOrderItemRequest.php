<?php

namespace App\Http\Requests;

use App\Rules\{ValidItemForCancellation, ValidOrderForCancellation};
use App\Trait\FailValidate;
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
