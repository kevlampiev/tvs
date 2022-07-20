<?php

use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\VehicleConditionController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleIncidentController;
use App\Http\Controllers\Admin\VehicleLocationController;
use App\Http\Controllers\Admin\VehicleNoteController;
use App\Http\Controllers\Admin\VehiclePhotoController;
use App\Http\Controllers\Admin\VehiclePlacementController;
use App\Http\Controllers\Admin\VehicleTypeController;
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
    'prefix' => 'locations'
],
    function () {
        Route::get('/',[VehicleLocationController::class, 'index'])
        ->name('locations');
        Route::get('/add', [VehicleLocationController::class, 'create'])
            ->name('addLocation');
        Route::post('/add', [VehicleLocationController::class, 'store']);
        Route::get('/{location}/edit', [VehicleLocationController::class, 'edit'])
            ->name('editLocation');
        Route::post('/{location}/edit', [VehicleLocationController::class, 'update']);
        Route::match(['get', 'post'], '{location}/delete', [VehicleLocationController::class, 'destroy'])
            ->name('deleteLocation');
    }
);

Route::group(['prefix'=>'placements'],
    function () {
        Route::get('{vehicle}/add', [VehiclePlacementController::class, 'create'])->name('addPlacement');
        Route::post('{vehicle}/add', [VehiclePlacementController::class, 'store']);
        Route::get('{placement}/edit', [VehiclePlacementController::class, 'edit'])
            ->name('editPlacement');
        Route::post('{placement}/edit', [VehiclePlacementController::class, 'update']);
        Route::match(['get','post'], '{placement}/delete}',[VehiclePlacementController::class, 'destroy'])
            ->name('deletePlacement');
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
                Route::get('show/{vehiclePhoto}', [VehiclePhotoController::class, 'show'])
                    ->name('showVehiclePhoto');
            });

        Route::group(['prefix' => 'incidents'],
            function () {
                Route::get('add/{vehicle}', [VehicleIncidentController::class, 'create'])
                    ->name('addVehicleIncident');
                Route::post('add/{vehicle}', [VehicleIncidentController::class, 'store']);
                Route::get('edit/{vehicleIncident}', [VehicleIncidentController::class, 'edit'])
                    ->name('editVehicleIncident');
                Route::post('edit/{vehicleIncident}', [VehicleIncidentController::class, 'update']);
                Route::get('delete/{vehicleIncident}', [VehicleIncidentController::class, 'erase'])
                    ->name('deleteVehicleIncident');

            });
        Route::group(['prefix' => 'conditions'],
            function () {
                Route::get('add/{vehicle}', [VehicleConditionController::class, 'create'])
                    ->name('addVehicleCondition');
                Route::post('add/{vehicle}', [VehicleConditionController::class, 'store']);
                Route::get('edit/{vehicleCondition}', [VehicleConditionController::class, 'edit'])
                    ->name('editVehicleCondition');
                Route::post('edit/{vehicleCondition}', [VehicleConditionController::class, 'update']);
                Route::get('delete/{vehicleCondition}', [VehicleConditionController::class, 'erase'])
                    ->name('deleteVehicleCondition');

            });

    });
