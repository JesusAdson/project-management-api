<?php

namespace App\Enums\Project;

enum ProjectStatusEnum: int
{
    case ACTIVE   = 0;
    case FINISHED = 1;
    case CANCELED = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE   => 'Active',
            self::FINISHED => 'Finished',
            self::CANCELED => 'Canceled',
        };
    }

    public static function getType(int $type): ProjectStatusEnum
    {
        return match ($type) {
            0 => self::ACTIVE,
            1 => self::FINISHED,
            2 => self::CANCELED,
        };
    }
}
