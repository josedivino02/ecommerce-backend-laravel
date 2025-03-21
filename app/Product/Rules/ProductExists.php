<?php

namespace App\Product\Rules;

use App\Product\Models\Product;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductExists implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product = Product::find($value);

        if (!$product) {
            $fail("The Product does not exists.");
        }
    }
}
