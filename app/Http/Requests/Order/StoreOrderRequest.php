<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use App\Rules\{AtLeastOneItem, ProductExists, QuantityProduct, ValidPaymentMethod, ValidShippingCost, ValidShippingMethod};
use App\Trait\FailValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreOrderRequest extends FormRequest
{
    use FailValidate;

    public function authorize(): bool
    {
        return Gate::allows("create", Order::class);
    }

    public function rules(): array
    {
        return [
            "shipping_address"   => ["required"],
            "billing_address"    => ["required"],
            "payment_method"     => ["required", new ValidPaymentMethod()],
            "shipping_method"    => ["required", new ValidShippingMethod()],
            "shipping_costs_id"  => ["required", new ValidShippingCost()],
            "discount"           => ["required", "numeric", "min:0"],
            "items"              => ["required", "array", new AtLeastOneItem()],
            "items.*.product_id" => ["required", "numeric", "integer", new ProductExists()],
            "items.*.quantity"   => ["required", "numeric", "integer", $this->validateQuantityWithProductId()],
            "items.*.unit_price" => ["required", "numeric", "min:0"],
        ];
    }

    protected function validateQuantityWithProductId(): callable
    {
        return function ($attribute, $value, $fail) {
            $index     = $this->extractIndex($attribute);
            $productId = $this->input("items.{$index}.product_id");
            (new QuantityProduct($productId))->validate($attribute, $value, $fail);
        };
    }

    protected function extractIndex(string $attribute): ?int
    {
        preg_match('/items\.(\d+)\.quantity/', $attribute, $matches);

        return $matches[1] ?? null;
    }

}