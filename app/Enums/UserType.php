<?php

namespace App\Enums;

enum UserType: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case MANAGER = 'manager';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return [
            self::USER->value => 'Regular User',
            self::ADMIN->value => 'Administrator',
            self::MANAGER->value => 'Manager',
        ];
    }

    public function label(): string
    {
        return match($this) {
            self::USER => 'Regular User',
            self::ADMIN => 'Administrator',
            self::MANAGER => 'Manager',
        };
    }
}
