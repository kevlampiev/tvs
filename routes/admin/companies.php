<?php

use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\AgreementNoteController;
use App\Http\Controllers\Admin\AgreementPaymentController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CounterpartyController;
use App\Http\Controllers\Admin\CounterpartyEmployeeController;
use App\Http\Controllers\Admin\RealPaymentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'companies'
],
    function () {
        Route::get('/', [CompanyController::class, 'index'])
            ->name('companies');
        Route::get('add', [CompanyController::class, 'create'])
            ->name('addCompany');
        Route::post('add', [CompanyController::class, 'store']);
        Route::get('{company}/edit', [CompanyController::class, 'edit'])
            ->name('editCompany');
        Route::post('{company}/edit', [CompanyController::class, 'update']);
        Route::match(['post', 'get'],
            '{company}/delete', [CompanyController::class, 'destroy'])
            ->name('deleteCompany');
        Route::get('{company}/summary/{page?}', [CompanyController::class, 'summary'])
            ->name('companySummary');

    }

);

