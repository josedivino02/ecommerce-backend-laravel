<?php

namespace App\Rules\Order;

use App\Models\ShippingCost;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidShippingCost implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $shippingCostId = ShippingCost::where("id", $value);

        if (empty($shippingCostId)) {
            $fail("The $attribute must be a valid registered shipping cost");
        }
    }
}