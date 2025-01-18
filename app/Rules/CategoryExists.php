<?php

namespace App\Rules;

use App\Enums\CategoryStatus;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryExists implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $category = Category::where([
            ['status', CategoryStatus::ACTIVE->value],
            ['id', $value],
        ])->first();

        if (!$category) {
            $fail("The Category does not exists.");
        }
    }
}
