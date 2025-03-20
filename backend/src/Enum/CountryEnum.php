<?php

namespace App\Enum;

enum CountryEnum: string
{
    case FRANCE = 'france';
    case GERMANY = 'germany';
    case ITALY = 'italy';
    case SPAIN = 'spain';

    public const VALUES = [
        self::FRANCE->value,
        self::GERMANY->value,
        self::ITALY->value,
        self::SPAIN->value,
    ];
}
