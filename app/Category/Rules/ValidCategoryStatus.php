<?php

namespace App\Category\Rules;

use App\Category\Enums\CategoryStatus;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCategoryStatus implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, CategoryStatus::values())) {
            $fail("The $attribute field must be a valid category status.");
        }
    }
}
