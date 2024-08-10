<?php

namespace App\Actions\Project;

use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateProject
{
    /**
     * @throws Exception
     */
    public function __invoke(ProjectRequest $request): ProjectResource
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $project = Project::query()->create($data);
            DB::commit();

            return new ProjectResource($project);
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage(), 422);
        }
    }
}
