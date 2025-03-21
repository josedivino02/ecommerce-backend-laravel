<?php

namespace App\Order\Enums;

enum PaymentMethod: string
{
    case CREDIT_CARD = "credit_card";
    case DEBIT_CARD  = "debit_card";
    case PAYPAL      = "paypal";
    case PIX         = "pix";
    case BOLETO      = "boleto";
    case CASH        = "cash";

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}
