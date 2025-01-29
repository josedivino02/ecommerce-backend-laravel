<?php

namespace App\Rules\Order;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AtLeastOneItem implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value) || count($value) < 1) {
            $fail("The order must contain at least one item");
        }
    }
}