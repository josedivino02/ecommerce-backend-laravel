<?php

namespace App\Product\Rules;

use App\Product\Models\Product;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class QuantityProduct implements ValidationRule
{
    public function __construct(protected int $productId)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $productId = $this->productId;

        $product = Product::find($productId);

        if (!$product) {
            $fail("Product not found for quantity validation.");

            return;
        }

        if ($value > $product->stock) {
            $fail("The requested quantity ({$value}) exceeds the available stock ({$product->stock}).");
        }
    }
}