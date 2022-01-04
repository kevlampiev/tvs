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
    }
);
