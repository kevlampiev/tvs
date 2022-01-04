<?php

use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleNoteController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Admin\VehiclePhotoController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'types'
],
    function () {
        Route::get('/', [VehicleTypeController::class, 'index'])
            ->name('vehicleTypes');
        Route::get('add', [VehicleTypeController::class, 'create'])
            ->name('addVehicleType');
        Route::post('add', [VehicleTypeController::class, 'store']);
        Route::get('{vehicleType}/edit', [VehicleTypeController::class, 'edit'])
            ->name('editVehicleType');
        Route::post('{vehicleType}/edit', [VehicleTypeController::class, 'update']);
        Route::match(['post', 'get'], '{vehicleType}/delete', [VehicleTypeController::class, 'erase'])
            ->name('deleteVehicleType');
    }
);

Route::group([
    'prefix' => 'manufacturers'
],
    function () {
        Route::get('/', [ManufacturersController::class, 'index'])->name('manufacturers');
        Route::get('add', [ManufacturersController::class, 'create'])
            ->name('addManufacturer');
        Route::post('add', [ManufacturersController::class, 'store']);
        Route::get('{manufacturer}/edit', [ManufacturersController::class, 'edit'])
            ->name('editManufacturer');
        Route::post('{manufacturer}/edit', [ManufacturersController::class, 'update']);
        Route::match(['post', 'get'], '{manufacturer}/delete', [ManufacturersController::class, 'destroy'])
            ->name('deleteManufacturer');
    }
);


Route::group([
    'prefix' => 'vehicles'
],
    function () {
        Route::get('/', [VehicleController::class, 'index'])->name('vehicles');
        Route::get('add', [VehicleController::class, 'create'])->name('addVehicle');
        Route::post('add', [VehicleController::class, 'store']);
        Route::get('{vehicle}/edit', [VehicleController::class, 'edit'])->name('editVehicle');
        Route::post('{vehicle}/edit', [VehicleController::class, 'update']);

        Route::match(['post', 'get'], '{vehicle}/delete', [VehicleController::class, 'erase'])->name('deleteVehicle');
        Route::get('{vehicle}/summary/{page?}', [VehicleController::class, 'vehicleSummary'])->name('vehicleSummary');
        Route::match(['get', 'post'], '{vehicle}/attach-agreement', [VehicleController::class, 'attachAgreement'])
            ->name('attachAgreement');
        Route::get('{vehicle}/detach-agreement/{agreement}', [VehicleController::class, 'detachAgreement'])
            ->name('detachAgreement');
        Route::group(['prefix' => 'notes'],
            function () {
                Route::get('add/{vehicle}', [VehicleNoteController::class, 'create'])
                    ->name('addVehicleNote');
                Route::post('add/{vehicle}', [VehicleNoteController::class, 'store']);
                Route::get('edit/{vehicleNote}', [VehicleNoteController::class, 'edit'])
                    ->name('editVehicleNote');
                Route::post('edit/{vehicleNote}', [VehicleNoteController::class, 'update']);
                Route::get('delete/{vehicleNote}', [VehicleNoteController::class, 'erase'])
                    ->name('deleteVehicleNote');

            });
        Route::group(['prefix' => 'photos'],
            function () {
                Route::get('add/{vehicle}', [VehiclePhotoController::class, 'create'])
                    ->name('addVehiclePhoto');
                Route::post('add/{vehicle}', [VehiclePhotoController::class, 'store']);
                Route::get('edit/{vehiclePhoto}', [VehiclePhotoController::class, 'edit'])
                    ->name('editVehiclePhoto');
                Route::post('edit/{vehiclePhoto}', [VehiclePhotoController::class, 'update']);
                Route::get('delete/{vehiclePhoto}', [VehiclePhotoController::class, 'erase'])
                    ->name('deleteVehiclePhoto');
                Route::get('show/{vehiclePhoto}',[VehiclePhotoController::class, 'show'])
                    ->name('showVehiclePhoto');
            });
    });
