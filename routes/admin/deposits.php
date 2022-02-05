<?php

use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix'=>'deposits',
],
    function() {
        Route::get('{agreement}/add', [DepositController::class, 'create'])
            ->name('addDeposit');
        Route::post('{agreement}/add', [DepositController::class, 'store']);
        Route::get('attachToVehicle/{vehicle}', [DepositController::class, 'createForVehicle'])
            ->name('addVehicleToDeposit');
        Route::post('attachToVehicle/{vehicle}', [DepositController::class, 'store']);
        Route::get('{deposit}/edit', [DepositController::class, 'edit'])
            ->name('editDeposit');
        Route::post('{deposit}/edit', [DepositController::class, 'update']);
        Route::match(['post','get'],'{deposit}/delete', [DepositController::class, 'delete'])
            ->name('deleteDeposit');
});
