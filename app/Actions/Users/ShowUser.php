<?php

namespace App\Actions\Users;

use App\Exceptions\NotFoundException;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class ShowUser
{
    /**
     * @throws NotFoundException
     */
    public function __invoke(int $user_id): UserResource
    {
        $user = $this->getUser($user_id);

        return new UserResource($user);
    }

    /**
     * @throws NotFoundException
     */
    private function getUser(int $user_id): User
    {
        /**@var ?User $user*/
        $user = User::query()->find($user_id);

        if (is_null($user)) {
            throw new NotFoundException('User not found.');
        }

        return $user;
    }
}
