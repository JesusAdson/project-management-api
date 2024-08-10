<?php

namespace App\Actions\Project;

use App\Exceptions\NotFoundException;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;

class ShowProject
{
    /**
     * @throws NotFoundException
     */
    public function __invoke(int $project_id): ProjectResource
    {
        $project = $this->getProject($project_id);

        if (!$project) {
            throw new NotFoundException('Project not found.');
        }

        return new ProjectResource($project);
    }

    private function getProject(int $project_id): ?Project
    {
        /**@var ?Project*/
        return Project::query()->find($project_id);
    }
}
