<?php

namespace App\Rules;

use App\Enums\Payment\PaymentStatus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPaymentStatus implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, PaymentStatus::values())) {
            $fail("The $attribute field must be a valid payment status.");
        }
    }
}