<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix'=>'projects',
],
    function() {
        Route::get('/', [TaskController::class, 'index'])
            ->name('projects');
        Route::get('/add', [ProjectController::class, 'create'])
            ->name('addProject');
        Route::post('/add', [ProjectController::class, 'store'])
            ->name('addProject');
    });


Route::group([
    'prefix' => 'tasks'
],
    function () {

        Route::get('{task}/card', [TaskController::class, 'viewTaskCard'])
            ->name('taskCard');
        Route::get('{user}/user-tasks', [TaskController::class, 'viewUserTasks'])
            ->name('userTasks');
        Route::get('{parentTask}/addSubTask', [TaskController::class, 'createSubTask'])
            ->name('addSubTask');
        Route::post('/add', [TaskController::class, 'store'])
            ->name('addTask');
        Route::get('{task}/edit', [TaskController::class, 'edit'])
            ->name('editTask');
        Route::post('{task}/edit', [TaskController::class, 'update']);
        Route::get('{task}/complete', [TaskController::class, 'markAsDone'])
            ->name('markTaskAsDone');
        Route::get('{task}/cancel', [TaskController::class, 'markAsCanceled'])
            ->name('markTaskAsCanceled');
        Route::get('{task}/restore', [TaskController::class, 'markAsRunning'])
            ->name('markTaskAsRunning');
        Route::get('{task}/addMessage', [TaskController::class, 'addMessage'])
            ->name('addTaskMessage');
        Route::post('{task}/addMessage', [TaskController::class, 'storeMessage']);

    }
);
