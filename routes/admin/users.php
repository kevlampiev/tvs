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

    Route::get('/', [UsersController::class, 'index'])
        ->name('users');
    Route::match(['post', 'get'], 'add', [UsersController::class, 'add'])
        ->name('addUser');
    Route::match(['post', 'get'], '{user}/edit', [UsersController::class, 'edit'])
        ->name('editUser');
    Route::match(['post', 'get'], '{user}/delete', [UsersController::class, 'delete'])
        ->name('deleteUser');
    Route::match(['get', 'post'], '{user}/setTmpPswd', [UsersController::class, 'setTempPassword'])
        ->name('setTempPassword');
