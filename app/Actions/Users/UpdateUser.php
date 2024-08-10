<?php

namespace App\Actions\Users;

use App\Exceptions\{DefaultException, NotFoundException};
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateUser
{
    /**
     * @throws DefaultException
     * @throws NotFoundException
     */
    public function __invoke(UserRequest $request, int $user_id): UserResource
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $user = $this->getUser($user_id);

            $user->update($data);
            DB::commit();

            return new UserResource($user);
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
