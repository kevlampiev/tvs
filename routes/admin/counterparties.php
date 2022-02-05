<?php

use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\AgreementNoteController;
use App\Http\Controllers\Admin\AgreementPaymentController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\CounterpartyController;
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

