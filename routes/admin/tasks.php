<?php

use App\Http\Controllers\Admin\InsuranceCompanyController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\InsuranceTypesController;
use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'tasks'
],
    function () {
        Route::get('/', [TaskController::class, 'index'])
            ->name('tasks');
        Route::get('{task}/card', [TaskController::class, 'viewTaskCard'])
            ->name('taskCard');
        Route::get('{user}/user-tasks', [TaskController::class, 'viewUserTasks'])
            ->name('userTasks');
        Route::get('/add', [TaskController::class, 'create'])
            ->name('addTask');
        Route::get('{parentTask}/addSubTask', [TaskController::class, 'createSubTask'])
            ->name('addSubTask');
        Route::post('/add', [TaskController::class, 'store']);
        Route::get('{task}/edit', [TaskController::class, 'edit'])
            ->name('editTask');
        Route::post('{task}/edit', [TaskController::class, 'update']);
        Route::get('{task}/complete', [TaskController::class, 'markAsDone'])
            ->name('markTaskAsDone');
        Route::get('{task}/cancel', [TaskController::class, 'markAsCanceled'])
            ->name('markTaskAsCanceled');

    }
);
