<?php

namespace App\Actions\Task;

use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListTask
{
    public function __invoke(): AnonymousResourceCollection
    {
        $tasks = Task::query()
            ->with([
                'project',
                'users',
                'createdBy',
            ])
            ->get();

        return TaskResource::collection($tasks);
    }
}
