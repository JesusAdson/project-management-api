<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class Login
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->getUser($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken($user->name . '--AuthToken')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    private function getUser(string $email): ?User
    {
        /**@var ?User*/
        return User::query()
            ->where('email', $email)
            ->first();
    }
}
