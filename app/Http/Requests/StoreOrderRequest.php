<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Rules\{ValidPaymentMethod, ValidShippingMethod};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows("create", Order::class);
    }

    public function rules(): array
    {
        return [
            "shipping_address" => ["required"],
            "billing_address"  => ["required"],
            "payment_method"   => ["required", new ValidPaymentMethod()],
            "shipping_method"  => ["required", new ValidShippingMethod()],
            "shipping_cost"    => ["required"],
            "total_price"      => ["required"],
            "discount"         => ["required"],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
