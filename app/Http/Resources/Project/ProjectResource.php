<?php

namespace App\Http\Resources\Project;

use App\Enums\Project\{ProjectStatusEnum, ProjectUserRoleEnum};
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'start_date'  => $this->start_date,
            'end_date'    => $this->end_date,
            'status'      => $this->status?->getLabel() ?? ProjectStatusEnum::ACTIVE->getLabel(),
            'created_by'  => $this->createdBy?->name ?? null,
            'users'       => $this->users->map(
                fn (User $user) => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => ProjectUserRoleEnum::getType($user->getOriginal()['pivot_role'])->getLabel(),
                ]
            ),
        ];
    }
}
