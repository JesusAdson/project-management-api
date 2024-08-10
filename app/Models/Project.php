<?php

namespace App\Models;

use App\Enums\Project\ProjectStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function createBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
            ->withPivot(['role']);
    }
}
