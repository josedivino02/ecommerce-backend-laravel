<?php

namespace App\Product\Rules;

use App\Product\Enums\ProductStatus;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidProductStatus implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, ProductStatus::values())) {
            $fail("The $attribute field must be a valid product status");
        }
    }
}
