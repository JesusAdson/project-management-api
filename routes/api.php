<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::prefix('/projects')
            ->group(function () {
                Route::get('/', \App\Actions\Project\ListProject::class);
                Route::post('/', \App\Actions\Project\CreateProject::class);
                Route::get('/{project_id}', \App\Actions\Project\ShowProject::class);
                Route::put('/{project_id}', \App\Actions\Project\UpdateProject::class);
                Route::delete('/{project_id}', \App\Actions\Project\DeleteProject::class);

                Route::prefix('{project_id}/tasks')
                    ->group(function () {
                        Route::get('/', \App\Actions\Task\ListTask::class);
                        Route::post('/', \App\Actions\Task\CreateTask::class);
                        Route::patch('/{task_id}/update', \App\Actions\Task\UpdateTaskStatus::class);
                        Route::put('/{task_id}/update', \App\Actions\Task\UpdateTask::class);
                        Route::delete('/{task_id}/delete', \App\Actions\Task\DeleteTask::class);
                    });
            });

        Route::prefix('/users')
            ->group(function () {
                Route::get('/', \App\Actions\Users\ListUser::class);
                Route::post('/', \App\Actions\Users\CreateUser::class);
                Route::get('/{user_id}', \App\Actions\Users\ShowUser::class);
                Route::put('/{user_id}', \App\Actions\Users\UpdateUser::class);
                Route::delete('/{user_id}', \App\Actions\Users\DeleteUser::class);
            });
    });

Route::prefix('/auth')
    ->group(function () {
        Route::post('/login', \App\Actions\Auth\Login::class);
        Route::middleware('auth:sanctum')->post('/logout', \App\Actions\Auth\Logout::class);
    });
