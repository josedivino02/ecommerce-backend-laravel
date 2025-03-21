<?php

namespace App\Product\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidProductForDelete implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value->exists()) {
            $fail("");
        }
    }
}
