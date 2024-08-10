<?php

namespace App\Enums\Project;

enum ProjectUserRoleEnum: string
{
    case ADMIN  = 'admin';
    case MEMBER = 'member';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN  => 'Admin',
            self::MEMBER => 'Member',
        };
    }

    public static function getType(string $type): ProjectUserRoleEnum
    {
        return match ($type) {
            'admin'  => self::ADMIN,
            'member' => self::MEMBER,
        };
    }
}
