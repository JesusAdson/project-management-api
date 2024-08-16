<?php

namespace App\Http\Requests\Task;

enum TaskStatusEnum: int
{
    case PENDING   = 0;
    case IN_PROGRESS = 1;
    case FINISHED = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING   => 'Pending',
            self::IN_PROGRESS => 'In progress',
            self::FINISHED => 'Finished',
        };
    }

    public static function getType(int $type): TaskStatusEnum
    {
        return match ($type) {
            0 => self::PENDING,
            1 => self::IN_PROGRESS,
            2 => self::FINISHED,
        };
    }
}
