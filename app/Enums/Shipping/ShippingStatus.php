<?php

namespace App\Enums\Shipping;

enum ShippingStatus: string
{
    case PENDING    = "pending";
    case PROCESSING = "processing";
    case SHIPPED    = "shipped";
    case DELIVERED  = "delivered";
    case CANCELED   = "canceled";

    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}