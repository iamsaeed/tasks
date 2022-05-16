<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function()
{
    Route::view('/projects-list', 'projects')->name('projects');

    Route::view('/task-status-list', 'task_statuses')->name('task.statuses');

    Route::get('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'show']);

    Route::view('/home', 'home')->name('home');

    Route::post('/add-project', [\App\Http\Controllers\ProjectController::class, 'add']);
    Route::get('/get-projects', [\App\Http\Controllers\ProjectController::class, 'get']);
    Route::get('/get-active-projects', [\App\Http\Controllers\ProjectController::class, 'getActive']);

    Route::post('/add-task', [\App\Http\Controllers\TaskController::class, 'add']);
    Route::get('/get-tasks', [\App\Http\Controllers\TaskController::class, 'get']);
    Route::post('/delete-tasks', [\App\Http\Controllers\TaskController::class, 'destroy']);
    Route::get('/getTask/{task}', [\App\Http\Controllers\TaskController::class, 'getTask']);

    Route::post('/add_task_status', [\App\Http\Controllers\TaskStatusController::class, 'add']);
    Route::get('/get_task_statuses', [\App\Http\Controllers\TaskStatusController::class, 'get']);
    Route::get('/get_active_task_statuses', [\App\Http\Controllers\TaskStatusController::class, 'getActive']);

    Route::post('/uploadAttachment', [\App\Http\Controllers\ImageController::class, 'uploadAttachment']);

    Route::post('/addComment', [\App\Http\Controllers\CommentController::class, 'add']);
});

Auth::routes();
