<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/index', [HomeController::class, 'index'])->name('main');

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
    }
);
