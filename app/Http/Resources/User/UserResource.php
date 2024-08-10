<?php

namespace App\Http\Resources\User;

use App\Enums\Project\{ProjectStatusEnum, ProjectUserRoleEnum};
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'email'    => $this->email,
            'projects' => $this->projects->map(
                fn (Project $project) => [
                    'id'          => $project->id,
                    'name'        => $project->name,
                    'description' => $project->description,
                    'start_date'  => $project->start_date,
                    'end_date'    => $project->end_date,
                    'status'      => $project->status?->getLabel() ?? ProjectStatusEnum::ACTIVE->getLabel(),
                    'created_by'  => $project->createdBy?->name ?? null,
                    'role'        => ProjectUserRoleEnum::getType($project->getOriginal()['pivot_role']),
                ]
            ),
        ];
    }
}
