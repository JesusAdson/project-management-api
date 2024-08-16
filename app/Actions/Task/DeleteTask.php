<?php

namespace App\Actions\Task;

use App\Exceptions\DefaultException;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class DeleteTask
{
    /**
     * @throws DefaultException
     */
    public function __invoke(int $project_id, int $task_id): Response
    {
        DB::beginTransaction();

        try {
            $task = Task::query()->find($task_id);
            $task->delete();
            DB::commit();

            return response()->noContent();
        } catch (Exception $e) {
            DB::rollBack();

            throw new DefaultException($e->getMessage());
        }
    }
}
