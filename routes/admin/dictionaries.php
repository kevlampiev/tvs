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

Route::get('/', [HomeController::class, 'index'])->name('main');
Route::group([
    'prefix' => 'types'
],
    function () {
        Route::get('/', [VehicleTypeController::class, 'index'])
            ->name('vehicleTypes');
        Route::get('add', [VehicleTypeController::class, 'create'])
            ->name('addVehicleType');
        Route::post('add', [VehicleTypeController::class, 'store']);
        Route::get( '{vehicleType}/edit', [VehicleTypeController::class, 'edit'])
            ->name('editVehicleType');
        Route::post( '{vehicleType}/edit', [VehicleTypeController::class, 'update']);
        Route::match(['post', 'get'], '{vehicleType}/delete', [VehicleTypeController::class, 'erase'])
            ->name('deleteVehicleType');
    }
);

Route::group([
    'prefix' => 'manufacturers'
],
    function () {
        Route::get('/', [ManufacturersController::class, 'index'])->name('manufacturers');
        Route::get( 'add', [ManufacturersController::class, 'create'])
            ->name('addManufacturer');
        Route::post( 'add', [ManufacturersController::class, 'store']);
        Route::get( '{manufacturer}/edit', [ManufacturersController::class, 'edit'])
            ->name('editManufacturer');
        Route::post( '{manufacturer}/edit', [ManufacturersController::class, 'update']);
        Route::match(['post', 'get'], '{manufacturer}/delete', [ManufacturersController::class, 'destroy'])
            ->name('deleteManufacturer');
    }
);

Route::group([
    'prefix' => 'agrTypes'
],
    function () {
        Route::get('/', [AgreementTypeController::class, 'index'])
            ->name('agrTypes');
        Route::get('add', [AgreementTypeController::class, 'create'])
            ->name('addAgrType');
        Route::post('add',[AgreementTypeController::class,'store']);
        Route::get('{agrType}/edit', [AgreementTypeController::class, 'edit'])
            ->name('editAgrType');
        Route::post('{agrType}/edit', [AgreementTypeController::class, 'update']);
        Route::match(['post', 'get'],
            '{agrType}/delete', [AgreementTypeController::class, 'destroy'])
            ->name('deleteAgrType');
    }
);

Route::group([
    'prefix' => 'counterparties'
],
    function () {
        Route::get('/', [CounterpartyController::class, 'index'])
            ->name('counterparties');
        Route::get('add', [CounterpartyController::class, 'create'])
            ->name('addCounterparty');
        Route::post('add', [CounterpartyController::class, 'store']);
        Route::get('{counterparty}/edit',[CounterpartyController::class,'edit'])
            ->name('editCounterparty');
        Route::post('{counterparty}/edit',[CounterpartyController::class,'update']);
        Route::match(['post', 'get'],
            '{counterparty}/delete', [CounterpartyController::class, 'destroy'])
            ->name('deleteCounterparty');
    }
);

Route::group([
    'prefix' => 'companies'
],
    function () {
        Route::get('/', [CompanyController::class, 'index'])
            ->name('companies');
        Route::get('add', [CompanyController::class, 'create'])
            ->name('addCompany');
        Route::post('add',[CompanyController::class,'store']);
        Route::get('{company}/edit', [CompanyController::class, 'edit'])
            ->name('editCompany');
        Route::post('{company}/edit', [CompanyController::class, 'update']);
        Route::match(['post', 'get'],
            '{company}/delete', [CompanyController::class, 'destroy'])
            ->name('deleteCompany');
    }
);

Route::group([
    'prefix' => 'insurance-companies'
],
    function () {
        Route::get('/', [InsuranceCompanyController::class, 'index'])
            ->name('insuranceCompanies');
        Route::get('add', [InsuranceCompanyController::class, 'create'])
            ->name('addInsuranceCompany');
        Route::post('add', [InsuranceCompanyController::class, 'store']);
        Route::get('{insuranceCompany}/edit', [InsuranceCompanyController::class, 'edit'])
            ->name('editInsuranceCompany');
        Route::post('{insuranceCompany}/edit', [InsuranceCompanyController::class, 'update'])
            ->name('editInsuranceCompany');
        Route::match(['post', 'get'],
            '{insuranceCompany}/delete', [InsuranceCompanyController::class, 'destroy'])
            ->name('deleteInsuranceCompany');
    }
);

Route::group([
    'prefix' => 'insurance-types'
],
    function () {
        Route::get('/', [InsuranceTypesController::class, 'index'])
            ->name('insuranceTypes');
        Route::get('add', [InsuranceTypesController::class, 'create'])
            ->name('addInsuranceType');
        Route::post('add', [InsuranceTypesController::class, 'store']);
        Route::get('{insuranceType}/edit', [InsuranceTypesController::class, 'edit'])
            ->name('editInsuranceType');
        Route::post('{insuranceType}/edit', [InsuranceTypesController::class, 'update']);
        Route::match(['post', 'get'],
            '{insuranceType}/delete', [InsuranceTypesController::class, 'destroy'])
            ->name('deleteInsuranceType');
    }
);
