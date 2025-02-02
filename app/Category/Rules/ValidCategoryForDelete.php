<?php

namespace App\Category\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCategoryForDelete implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value->products()->exists()) {
            $fail("The category belongs to a product and cannot be excluded.");
        }
    }
}