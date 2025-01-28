<?php

namespace App\Http\Requests\OrderItem;

use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderItemRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}