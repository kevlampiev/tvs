<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\GlobalSearchController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NearestPaymentsController;
use App\Http\Controllers\Admin\SettlementReportsController;
use App\Http\Controllers\Admin\InsurancesController;
use App\Http\Controllers\Admin\InsurancesToRenewalController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/index', [HomeController::class, 'index'])->name('main');
Route::get('/search', [GlobalSearchController::class, 'index'])->name('globalSearch');
Route::get('/settlements/all-v1',
            [SettlementReportsController::class, 'showBigSettlementReport'])
            ->name('allSettlements');
Route::get('/settlements/all-v2',
            [SettlementReportsController::class, 'showBigSettlement2Report'])
            ->name('allSettlements2');
Route::get('/settlements/nearest-payments',
            [NearestPaymentsController::class, 'showAllAgr'])
            ->name('nearestPayments');
Route::get('/settlements/{id}',
            [SettlementReportsController::class, 'showAgrSettlementReport'])
            ->name('agreementSettlements');
//Route::get('profile', [UserProfileController::class, 'edit'])
//            ->name('profileEdit');
//Route::post('profile', [UserProfileController::class, 'update']);
Route::get('/insurances/actual/by_ins_companies', [InsurancesController::class, 'index'])
    ->name('actualInsurancesByInsCompanies');
Route::get('/insurances/actual/by_ins_types', [InsurancesController::class, 'index'])
    ->name('actualInsurancesByInsTypes');
Route::get('/insurances/to-renewal', [InsurancesToRenewalController::class, 'index'])
    ->name('insurancesToRenewal');
Route::get('/insurances/insuredVehicles', [InsurancesController::class, 'actualInsurances'])
    ->name('insuredVehicles');

