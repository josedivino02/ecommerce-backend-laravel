<?php

namespace App\Product\Enums;

enum ProductStatus: string
{
    case ACTIVE   = 'active';
    case INACTIVE = 'inactive';

    /**
     * Get all values of the enum as an array.
     *
     * @return array<string> The array of enum values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
