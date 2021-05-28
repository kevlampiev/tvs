<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManufacturersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'admin'
],
    function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index']);
        Route::group([
            'prefix' => 'types'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\TypesController::class, 'index'])->name('admin.vehicleTypes');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\TypesController::class, 'addType'])->name('admin.addType');
                Route::match(['post', 'get'], '{type}/edit', [\App\Http\Controllers\Admin\TypesController::class, 'editType'])->name('admin.editType');
                Route::match(['post', 'get'], '{type}/delete', [\App\Http\Controllers\Admin\TypesController::class, 'deleteType'])->name('admin.deleteType');
            }
        );
        Route::group([
            'prefix' => 'manufacturers'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\ManufacturersController::class, 'index'])->name('admin.manufacturers');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\ManufacturersController::class, 'addManufacturer'])->name('admin.addManufacturer');
                Route::match(['post', 'get'], '{manufacturer}/edit', [\App\Http\Controllers\Admin\ManufacturersController::class, 'editManufacturer'])->name('admin.editManufacturer');
                Route::match(['post', 'get'], '{manufacturer}/delete', [\App\Http\Controllers\Admin\ManufacturersController::class, 'deleteManufacturer'])->name('admin.deleteManufacturer');
            }
        );

        Route::group([
            'prefix' => 'agrTypes'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'index'])
                    ->name('admin.agrTypes');
                Route::match(['post', 'get'],
                    'add', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'addType'])
                    ->name('admin.addAgrType');
                Route::match(['post', 'get'],
                    '{agrType}/edit', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'editType'])
                    ->name('admin.agrType');
                Route::match(['post', 'get'],
                    '{agrType}/delete', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'deleteType'])
                    ->name('admin.deleteAgrType');
            }
        );


        Route::group([
            'prefix' => 'vehicles'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('admin.vehicles');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\VehicleController::class, 'addVehicle'])->name('admin.addVehicle');
                Route::match(['post', 'get'], '{vehicle}/edit', [\App\Http\Controllers\Admin\VehicleController::class, 'editVehicle'])->name('admin.editVehicle');
                Route::match(['post', 'get'], '{vehicle}/delete', [\App\Http\Controllers\Admin\VehicleController::class, 'deleteVehicle'])->name('admin.deleteVehicle');
                Route::get( '{vehicle}/summary', [\App\Http\Controllers\Admin\VehicleController::class, 'vehicleSummary'])->name('admin.vehicleSummary');
            }
        );
    }
);
