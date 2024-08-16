<?php

namespace App\Actions\Task;

use App\Exceptions\DefaultException;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateTaskStatus
{
    /**
     * @throws DefaultException
     */
    public function __invoke(UpdateTaskStatusRequest $request, int $project_id, int $task_id): TaskResource
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $task         = Task::query()->find($task_id);
            $task->status = $data['status'];
            DB::commit();

            return new TaskResource($task);
        } catch (Exception $e) {
            DB::rollBack();

            throw new DefaultException($e->getMessage());
        }
    }
}
