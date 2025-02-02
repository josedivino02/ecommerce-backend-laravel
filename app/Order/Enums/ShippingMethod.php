<?php

namespace App\Order\Enums;

enum ShippingMethod: string
{
    case STANDARD = "standard";
    case EXPRESS  = "express";
    case SAME_DAY = "same_day";
    case PICKUP   = "pickup";
    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}