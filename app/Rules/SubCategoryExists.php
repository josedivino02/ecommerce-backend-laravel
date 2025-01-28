<?php

namespace App\Rules;

use App\Enums\Category\CategoryStatus;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SubCategoryExists implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $category = Category::where([
            ['status', CategoryStatus::ACTIVE->value],
            ['id', $value],
        ])->first();

        if (!$category) {
            $fail("The Sub Category does not exists.");
        }
    }
}