<?php

namespace App\Actions\Project;

use App\Exceptions\{DefaultException, NotFoundException};
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateProject
{
    /**
     * @throws DefaultException
     * @throws NotFoundException
     */
    public function __invoke(ProjectRequest $request, int $project_id): ProjectResource
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $project = $this->getProject($project_id);

            $project->update($data);
            DB::commit();

            return new ProjectResource($project);
        } catch (Exception $e) {
            DB::rollBack();

            throw new DefaultException($e->getMessage());
        } catch (NotFoundException $e) {
            throw new NotFoundException($e->getMessage());
        }
    }

    /**
     * @throws NotFoundException
     */
    private function getProject(int $project_id): ?Project
    {
        /**@var ?Project $project*/
        $project = Project::query()->find($project_id);

        if (!$project) {
            throw new NotFoundException('Project not found');
        }

        return $project;
    }
}
