<?php

namespace App\Actions\Task;

use App\Exceptions\DefaultException;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateTask
{
    /**
     * @throws DefaultException
     */
    public function __invoke(TaskRequest $request, int $project_id, int $task_id): TaskResource
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $task = Task::query()->find($task_id);
            $task->update($data);
            $this->attachUsers($task, [$data['user_id']]);
            DB::commit();

            return new TaskResource($task);
        } catch (Exception $e) {
            DB::rollBack();

            throw new DefaultException($e->getMessage());
        }
    }

    private function attachUsers(Task $task, array $users): void
    {
        $task->users()->detach();
        $task->users()->attach($users);
    }
}
