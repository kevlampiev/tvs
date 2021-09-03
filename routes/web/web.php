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
    'prefix' => 'user',
    'middleware' => ['auth', 'password_expired']
],
    function () {
        Route::get('/settlements/all-v1',
            [SettlementReportsController::class, 'showBigSettlementReport'])
            ->name('user.allSettlements');
        Route::get('/settlements/all-v2',
            [SettlementReportsController::class, 'showBigSettlement2Report'])
            ->name('user.allSettlements2');
        Route::get('/settlements/nearest-payments',
            [NearestPaymentsController::class,'showAllAgr'])
            ->name('user.nearestPayments');
        Route::get('/settlements/{id}',
            [SettlementReportsController::class, 'showAgrSettlementReport'])
            ->name('user.agreementSettlements');
        Route::get('profile', [UserProfileController::class,'edit'])
            ->name('user.profileEdit');
        Route::post('profile', [UserProfileController::class,'update']);
        Route::get('/insurances/to-renewal', [InsurancesToRenewalController::class, 'index'])
        ->name('user.insurancesToRenewal');
        Route::get('/filepreview/insurance-policy', [\App\Http\Controllers\User\FileDownloadController::class,'previewInsurance'])
            ->name('user.filePreview');
    });

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::match(['get', 'post'],'logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/expired', [ExpiredPasswordController::class, 'expired'])
    ->name('password.expired');
Route::post('password/expired', [ExpiredPasswordController::class, 'postExpired'])
    ->name('password.postExpired');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'password_expired']);

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth','password_expired']);

