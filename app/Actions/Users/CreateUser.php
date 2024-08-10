<?php

namespace App\Actions\Users;

use App\Exceptions\DefaultException;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateUser
{
    /**
     * @throws DefaultException
     */
    public function __invoke(UserRequest $request): UserResource
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $user = User::query()->create($data);
            DB::commit();

            return new UserResource($user);
        } catch (Exception $e) {
            DB::rollBack();
            throw new DefaultException($e->getMessage());
        }
    }
}
