<?php

use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\AgreementPaymentController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\BankStatementController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CounterpartyController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InsuranceCompanyController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\InsuranceTypesController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\RealPaymentController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleNoteController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Auth\ExpiredPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\InsurancesToRenewalController;
use App\Http\Controllers\User\NearestPaymentsController;
use App\Http\Controllers\User\SettlementReportsController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

    Route::get('/', [VehicleController::class, 'index'])->name('vehicles');
    Route::get( 'add', [VehicleController::class, 'create'])->name('addVehicle');
    Route::post( 'add', [VehicleController::class, 'store']);
    Route::get( '{vehicle}/edit', [VehicleController::class, 'edit'])->name('editVehicle');
    Route::post( '{vehicle}/edit', [VehicleController::class, 'update']);

    Route::match(['post', 'get'], '{vehicle}/delete', [VehicleController::class, 'erase'])->name('deleteVehicle');
    Route::get('{vehicle}/summary/{page?}', [VehicleController::class, 'vehicleSummary'])->name('vehicleSummary');
    Route::match(['get','post'], '{vehicle}/attach-agreement', [VehicleController::class, 'attachAgreement'])
        ->name('attachAgreement');
    Route::get('{vehicle}/detach-agreement/{agreement}', [VehicleController::class, 'detachAgreement'])
        ->name('detachAgreement');
    Route::group(['prefix' => 'notes'],
        function() {
            Route::get('add/{vehicle}', [VehicleNoteController::class, 'create'])
                ->name('addVehicleNote');
            Route::post('add/{vehicle}', [VehicleNoteController::class, 'store']);
            Route::get('edit/{vehicleNote}', [VehicleNoteController::class, 'edit'])
                ->name('editVehicleNote');
            Route::post('edit/{vehicleNote}', [VehicleNoteController::class, 'update']);
            Route::get('delete/{vehicleNote}', [VehicleNoteController::class, 'erase'])
                ->name('deleteVehicleNote');

        });
