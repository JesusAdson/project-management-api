<?php

namespace App\Actions\Users;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListUser
{
    public function __invoke(): AnonymousResourceCollection
    {
        $users = User::query()->get();

        return UserResource::collection($users);
    }
}
