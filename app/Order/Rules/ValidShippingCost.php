<?php

namespace App\Order\Rules;

use App\Order\Models\ShippingCost;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

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