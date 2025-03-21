<?php

namespace App\Category\Rules;

use App\Category\Enums\CategoryStatus;
use App\Category\Models\Category;

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
