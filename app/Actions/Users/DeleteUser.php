<?php

namespace App\Actions\Users;

use App\Exceptions\{DefaultException, NotFoundException};
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class DeleteUser
{
    /**
     * @throws DefaultException
     * @throws NotFoundException
     */
    public function __invoke(int $user_id): Response
    {
        DB::beginTransaction();

        try {
            $user = $this->getUser($user_id);

            $user->delete();
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
