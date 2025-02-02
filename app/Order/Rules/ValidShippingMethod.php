<?php

namespace App\Order\Rules;

use App\Order\Enums\ShippingMethod;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class ValidShippingMethod implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, ShippingMethod::values())) {
            $fail("The $attribute field must be a valid delivery method.");
        }
    }
}