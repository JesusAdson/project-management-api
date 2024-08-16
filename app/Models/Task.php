<?php

namespace App\Models;

use App\Enums\Task\TaskPriorityEnum;
use App\Http\Requests\Task\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'priority',
        'status',
        'start_date',
        'end_date',
        'created_by',
        'project_id',
    ];

    protected $casts = [
        'status'   => TaskStatusEnum::class,
        'priority' => TaskPriorityEnum::class,
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
