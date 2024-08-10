<?php

namespace App\Actions\Project;

use App\Exceptions\{DefaultException, NotFoundException};
use App\Models\Project;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class DeleteProject
{
    /**
     * @throws NotFoundException
     * @throws DefaultException
     */
    public function __invoke(int $project_id): Response
    {
        DB::beginTransaction();

        try {
            $project = $this->getProject($project_id);

            $project->delete();
            DB::commit();

            return response()->noContent();
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
