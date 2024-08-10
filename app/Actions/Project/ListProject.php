<?php

namespace App\Actions\Project;

use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListProject
{
    public function __invoke(): AnonymousResourceCollection
    {
        $filters = request()->filters;

        $projects = Project::query()
            ->when(
                isset($filters['name']),
                fn (Builder $query) => $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($filters['name']) . '%'])
            )
            ->where('status', $filters['status'])
            ->orderBy('start_date')
            ->get();

        return ProjectResource::collection($projects);
    }
}
