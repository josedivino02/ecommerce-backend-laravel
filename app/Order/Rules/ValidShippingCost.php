<?php

namespace App\Order\Rules;

use App\Order\Models\ShippingCost;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidShippingCost implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $shippingCostExists = ShippingCost::where("id", $value)
            ->exists();

        if (!$shippingCostExists) {
            $fail("The $attribute must be a valid registered shipping cost");
        }
    }
}
