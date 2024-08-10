<?php

namespace App\Models;

use App\Enums\Project\ProjectStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'status' => ProjectStatusEnum::class,
    ];
}
