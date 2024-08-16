<?php

namespace App\Actions\Auth;

use Illuminate\Http\Response;

class Logout
{
    public function __invoke(): Response
    {
        auth()->user()->tokens()->delete();

        return response()->noContent();
    }
}
