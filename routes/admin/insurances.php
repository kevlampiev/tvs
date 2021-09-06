<?php

use App\Http\Controllers\Admin\InsuranceCompanyController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\InsuranceTypesController;
use Illuminate\Support\Facades\Route;


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


Route::group([
    'prefix' => 'insurances'
],
    function () {
        Route::get('/', [InsuranceController::class, 'index'])
            ->name('insurances');
        Route::get('add/{vehicle?}', [InsuranceController::class, 'create'])
            ->name('addInsurance');
        Route::post('add/{vehicle?}', [InsuranceController::class, 'store']);
        Route::get('{insurance}/edit', [InsuranceController::class, 'edit'])
            ->name('editInsurance');
        Route::post('{insurance}/edit', [InsuranceController::class, 'update']);
        Route::match(['post', 'get'],
            '{insurance}/delete', [InsuranceController::class, 'delete'])
            ->name('deleteInsurance');

    });
