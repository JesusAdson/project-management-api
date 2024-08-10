<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/projects')
    ->group(function () {
        Route::post('/', \App\Actions\Project\CreateProject::class);
    });
