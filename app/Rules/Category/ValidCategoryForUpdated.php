<?php

namespace App\Rules\Category;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCategoryForUpdated implements ValidationRule
{
    public function __construct(private $status)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $category = $value;

        if (!$category) {
            $fail("Requested category were not found for cancellation.");

            return;
        }

        if ($category->status === $this->status) {
            $fail("The requested category has already been inactive");

            return;
        }

        if ($category->status === $this->status) {
            $fail("The requested category has already been active");

            return;
        }
    }
}