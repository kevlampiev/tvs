<?php

use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\AgreementNoteController;
use App\Http\Controllers\Admin\AgreementPaymentController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\CounterpartyController;
use App\Http\Controllers\Admin\CounterpartyEmployeeController;
use App\Http\Controllers\Admin\RealPaymentController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'counterparties'
],
    function () {
        Route::get('/', [CounterpartyController::class, 'index'])
            ->name('counterparties');
        Route::get('add', [CounterpartyController::class, 'create'])
            ->name('addCounterparty');
        Route::post('add', [CounterpartyController::class, 'store']);
        Route::get('{counterparty}/edit', [CounterpartyController::class, 'edit'])
            ->name('editCounterparty');
        Route::post('{counterparty}/edit', [CounterpartyController::class, 'update']);
        Route::match(['post', 'get'],
            '{counterparty}/delete', [CounterpartyController::class, 'destroy'])
            ->name('deleteCounterparty');
        Route::get('{counterparty}/summary', [CounterpartyController::class, 'summary'])
            ->name('counterpartySummary');
    }
);

Route::group([
    'prefix' => 'counterparty-staff'
],
    function () {
        Route::get('{counterparty}/add', [CounterpartyEmployeeController::class, 'create'])
            ->name('addCounterpartyEmployee');
        Route::post('{counterparty}/add', [CounterpartyEmployeeController::class, 'store']);
        Route::get('{employee}/edit', [CounterpartyEmployeeController::class, 'edit'])
            ->name('editCounterpartyEmployee');
        Route::post('{employee}/edit', [CounterpartyEmployeeController::class, 'update']);
        Route::match(['post', 'get'],
            '{employee}/delete', [CounterpartyEmployeeController::class, 'destroy'])
            ->name('deleteCounterpartyEmployee');

    }
);

