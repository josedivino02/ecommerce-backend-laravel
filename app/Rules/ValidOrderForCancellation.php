<?php

namespace App\Rules;

use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentStatus;
use App\Enums\Shipping\ShippingStatus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidOrderForCancellation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $order = $value;

        if (!$order) {
            $fail("Requested order were not found for cancellation.");

            return;
        }

        if ($order->status === OrderStatus::CANCELED->value) {
            $fail("The requested order has already been canceled.");

            return;
        }

        if ($order->payment_status === PaymentStatus::COMPLETED->value) {
            $fail("Payment for the requested order has already been made. To proceed with the cancellation, please request the corresponding refund.");

            return;
        }

        if ($order->payment_status === ShippingStatus::SHIPPED->value) {
            $fail("The requested order has already been sent to the registered address. To proceed with the cancellation, please request the corresponding refund.");

            return;
        }

        if ($order->status === OrderStatus::COMPLETED->value) {
            $fail("The requested order has already been completed and cannot be canceled.");
        }
    }
}