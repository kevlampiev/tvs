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
Route::group([
    'prefix' => 'documents'
],
    function () {
        Route::get('add/{vehicle}', [DocumentController::class, 'create'])
            ->name('addVehicleDocument');
        Route::post('add/{vehicle}', [DocumentController::class, 'store']);
        Route::get('edit/{document}', [DocumentController::class, 'edit'])
            ->name('editDocument');
        Route::post('edit/{document}', [DocumentController::class, 'update']);
        Route::get('delete/{document}', [DocumentController::class, 'erase'])
            ->name('deleteDocument');
        Route::get('/preview/{document}', [DocumentController::class, 'preview'])
            ->name('documentPreview');
    });
