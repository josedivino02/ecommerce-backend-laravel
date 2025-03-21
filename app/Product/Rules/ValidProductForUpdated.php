<?php

namespace App\Product\Rules;

use App\Product\Enums\ProductStatus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidProductForUpdated implements ValidationRule
{
    public function __construct(private readonly ProductStatus $status)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product = $value;

        if (!$product) {
            $fail("Requested product were not found for cancellation.");

            return;
        }

        if ($product->status === $this->status) {
            $fail("The requested product has already been inactive");

            return;
        }

        if ($product->status === $this->status) {
            $fail("The requested product has already been active");

            return;
        }
    }
}
