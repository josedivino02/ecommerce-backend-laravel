<?php

namespace App\Http\Requests;

use App\Rules\AtLeastOneItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * @property-read string $order
 */
class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('create', $this->route()->order);
    }

    public function rules(): array
    {
        return [
            'shipping_address' => ['required', 'string'],
            'billing_address'  => ['nullable', 'string'],
            'payment_method'   => ['required', 'string'],
            'shipping_method'  => ['required', 'string'],
            'shipping_cost'    => ['required', 'numeric'],
            'total_price'      => ['required', 'numeric'],
            'discount'         => ['required', 'numeric'],
            // 'items'            => ['required', 'array', new AtLeastOneItem()],
        ];
    }
}
