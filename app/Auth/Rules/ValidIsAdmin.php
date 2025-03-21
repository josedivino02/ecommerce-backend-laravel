<?php

namespace App\Auth\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidIsAdmin implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, ["S", "N"])) {
            $fail("The $attribute receives only the values: 'S' and 'N'");
        }
    }
}
