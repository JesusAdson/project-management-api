<?php

namespace App\Enums\Task;

enum TaskPriorityEnum: string
{
    case HIGH  = 'high';
    case MEDIUM = 'medium';
    case LOW = 'low';
    public function getLabel(): string
    {
        return match ($this) {
            self::HIGH  => 'High',
            self::MEDIUM => 'Medium',
            self::LOW => 'Low'
        };
    }

    public static function getType(string $type): TaskPriorityEnum
    {
        return match ($type) {
            'high'  => self::HIGH,
            'medium' => self::MEDIUM,
            'low' => self::LOW,
        };
    }
}
