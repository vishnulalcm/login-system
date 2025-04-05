<?php

namespace App\Enums;

enum Suffix: string
{
    case JR = 'Jr';
    case SR = 'Sr';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->value;
        }
        return $options;
    }
}
