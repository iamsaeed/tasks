<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function()
{
    Route::view('/projects-list', 'projects')->name('projects');

    Route::view('/tasks-list', 'tasks')->name('tasks');

    Route::view('/task-status-list', 'task_statuses')->name('task.statuses');

    Route::view('/home', 'home')->name('home');

    Route::prefix('api')->group(function()
    {
        Route::post('/add-project', [\App\Http\Controllers\ProjectController::class, 'add']);
        Route::get('/get-projects', [\App\Http\Controllers\ProjectController::class, 'get']);
        Route::get('/get-active-projects', [\App\Http\Controllers\ProjectController::class, 'getActive']);

        Route::post('/add-task', [\App\Http\Controllers\TaskController::class, 'add']);
        Route::get('/get-tasks', [\App\Http\Controllers\TaskController::class, 'get']);

        Route::post('/add_task_status', [\App\Http\Controllers\TaskStatusController::class, 'add']);
        Route::get('/get_task_statuses', [\App\Http\Controllers\ProjectController::class, 'get']);
        Route::get('/get_active_task_statuses', [\App\Http\Controllers\ProjectController::class, 'getActive']);
    });
});

Auth::routes();
