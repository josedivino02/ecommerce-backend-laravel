<?php

namespace App\Category\Enums;

enum CategoryStatus: string
{
    case ACTIVE   = 'active';
    case INACTIVE = 'inactive';

    /**
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
