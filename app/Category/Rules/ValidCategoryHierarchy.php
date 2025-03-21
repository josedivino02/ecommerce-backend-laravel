<?php

namespace App\Category\Rules;

use App\Category\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCategoryHierarchy implements ValidationRule
{
    public function __construct(private readonly Category $category)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->category === $value) {
            $fail("The category cannot be its own subcategory.");
        }
    }
}
