<?php

namespace App\Enums\Payment;

enum PaymentStatus: string
{
    case PENDING    = 'pending';
    case COMPLETED  = 'completed';
    case FAILED     = 'failed';
    case REFUNDED   = 'refunded';
    case CANCELED   = 'canceled';
    case PROCESSING = 'processing';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}