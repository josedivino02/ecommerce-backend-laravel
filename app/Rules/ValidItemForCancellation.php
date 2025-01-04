<?php

namespace App\Rules;

use App\Enums\OrderItemsStatus;
use App\Models\OrderItem;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidItemForCancellation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $item = OrderItem::withTrashed()->where("uuid", $value)->first();

        if (!$item) {
            $fail("Requested item were not found for cancellation.");

            return;
        }

        if ($item->status === OrderItemsStatus::CANCELED->value) {
            $fail("The requested order has already been canceled.");

        }
    }
}
