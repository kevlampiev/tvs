<?php

use App\Http\Controllers\Auth\ExpiredPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\InsurancesController;
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
//        Route::get('/settlements/all-v1',
//            [SettlementReportsController::class, 'showBigSettlementReport'])
//            ->name('user.allSettlements');
//        Route::get('/settlements/all-v2',
//            [SettlementReportsController::class, 'showBigSettlement2Report'])
//            ->name('user.allSettlements2');
//        Route::get('/settlements/nearest-payments',
//            [NearestPaymentsController::class, 'showAllAgr'])
//            ->name('user.nearestPayments');
//        Route::get('/settlements/{id}',
//            [SettlementReportsController::class, 'showAgrSettlementReport'])
//            ->name('user.agreementSettlements');
        Route::get('profile', [UserProfileController::class, 'edit'])
            ->name('user.profileEdit');
        Route::post('profile', [UserProfileController::class, 'update']);
//        Route::get('/insurances/actual/by_ins_companies', [InsurancesController::class, 'index'])
//            ->name('user.actualInsurancesByInsCompanies');
//        Route::get('/insurances/actual/by_ins_types', [InsurancesController::class, 'index'])
//            ->name('user.actualInsurancesByInsTypes');
//        Route::get('/insurances/to-renewal', [InsurancesToRenewalController::class, 'index'])
//            ->name('user.insurancesToRenewal');
//        Route::get('/insurances/insuredVehicles', [InsurancesController::class, 'actualInsurances'])
//            ->name('user.insuredVehicles');

        Route::get('/filepreview/insurance-policy', [\App\Http\Controllers\User\FileDownloadController::class, 'previewInsurance'])
            ->name('user.filePreview');

    });

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/expired', [ExpiredPasswordController::class, 'expired'])
    ->name('password.expired');
Route::post('password/expired', [ExpiredPasswordController::class, 'postExpired'])
    ->name('password.postExpired');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'password_expired']);
