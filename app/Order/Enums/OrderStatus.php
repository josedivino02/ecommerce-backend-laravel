<?php

namespace App\Order\Enums;

enum OrderStatus: string
{
    case PENDING    = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED  = 'completed';
    case CANCELED   = 'canceled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}