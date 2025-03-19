<?php

namespace App\Enum;

enum CategoryEnum: string
{
    case ACTIVITY = 'activity';
    case CLUB = 'club';
    case CONNECT = 'connect';
    case CULTURE = 'culture';
    case EDUCATION = 'education';
    case FASHION = 'fashion';
    case FOOD_SPOTS = 'food_spots';
    case LANGUAGE = 'language';
    case MEMES = 'memes';
    case POLITICS = 'politics';
    case SIGHTS = 'sights';
    case SPORTS = 'sports';

    public const VALUES = [
        self::ACTIVITY->value,
        self::CLUB->value,
        self::CONNECT->value,
        self::CULTURE->value,
        self::EDUCATION->value,
        self::FASHION->value,
        self::FOOD_SPOTS->value,
        self::LANGUAGE->value,
        self::MEMES->value,
        self::POLITICS->value,
        self::SIGHTS->value,
        self::SPORTS->value,
    ];
}
