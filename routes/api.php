<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/projects')
    ->group(function () {
        Route::get('/', \App\Actions\Project\ListProject::class);
        Route::post('/', \App\Actions\Project\CreateProject::class);
        Route::get('/{project_id}', \App\Actions\Project\ShowProject::class);
        Route::put('/{project_id}', \App\Actions\Project\UpdateProject::class);
        Route::delete('/{project_id}', \App\Actions\Project\DeleteProject::class);
    });

Route::prefix('/users')
    ->group(function () {
        Route::post('/', \App\Actions\Users\CreateUser::class);
    });
