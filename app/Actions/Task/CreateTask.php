<?php

namespace App\Actions\Task;

use App\Exceptions\DefaultException;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateTask
{
    /**
     * @throws DefaultException
     */
    public function __invoke(TaskRequest $request, int $project_id): TaskResource
    {
        $data = [...$request->validated(), 'project_id' => $project_id, 'created_by' => 1];

        DB::beginTransaction();

        try {
            $task = Task::query()->create($data);
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
        $task->users()->attach($users);
    }
}
