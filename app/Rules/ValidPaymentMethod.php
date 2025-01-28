<?php

namespace App\Rules;

use App\Enums\Payment\PaymentMethod;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPaymentMethod implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, PaymentMethod::values())) {
            $fail("The $attribute field must be a valid payment method.");
        }
    }
}