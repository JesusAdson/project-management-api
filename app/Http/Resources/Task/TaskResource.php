<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Project\ProjectResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'priority' => $this->priority->getLabel(),
            'status' => $this->status->getLabel(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project' => new ProjectResource($this->project),
            'users' => $this->users->map(
                fn (User $user) => [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'email'    => $user->email,
                ]
            )
        ];
    }
}
