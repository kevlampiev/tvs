<?php

use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\AgreementNoteController;
use App\Http\Controllers\Admin\AgreementPaymentController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\CounterpartyController;
use App\Http\Controllers\Admin\RealPaymentController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'agrTypes'
],
    function () {
        Route::get('/', [AgreementTypeController::class, 'index'])
            ->name('agrTypes');
        Route::get('add', [AgreementTypeController::class, 'create'])
            ->name('addAgrType');
        Route::post('add', [AgreementTypeController::class, 'store']);
        Route::get('{agrType}/edit', [AgreementTypeController::class, 'edit'])
            ->name('editAgrType');
        Route::post('{agrType}/edit', [AgreementTypeController::class, 'update']);
        Route::match(['post', 'get'],
            '{agrType}/delete', [AgreementTypeController::class, 'destroy'])
            ->name('deleteAgrType');
    }
);

Route::group([
    'prefix' => 'agreements'
],
    function () {
        Route::get('/list', [AgreementController::class, 'index'])
            ->name('agreements');
        Route::get('add', [AgreementController::class, 'create'])
            ->name('addAgreement');
        Route::post('add', [AgreementController::class, 'store']);
        Route::get('{agreement}/edit', [AgreementController::class, 'edit'])
            ->name('editAgreement');
        Route::post('{agreement}/edit', [AgreementController::class, 'update']);
        Route::match(['post', 'get'], '{agreement}/delete', [AgreementController::class, 'delete'])
            ->name('deleteAgreement');
        Route::get('{agreement}/summary/{page?}', [AgreementController::class, 'summary'])
            ->name('agreementSummary');
        Route::match(['get', 'post'], '{agreement}/add-vehicle', [AgreementController::class, 'addVehicle'])
            ->name('agreementAddVehicle');
        Route::get('{agreement}/detach-vehicle/{vehicle}', [AgreementController::class, 'detachVehicle'])
            ->name('agreementDetachVehicle');
//                Платежи по договору
        Route::get('{agreement}/add-payment', [AgreementPaymentController::class, 'create'])
            ->name('addAgrPayment');
        Route::post('{agreement}/add-payment', [AgreementPaymentController::class, 'store']);
        Route::get('{agreement}/add-massive-payments', [AgreementPaymentController::class, 'createAddPayments'])
            ->name('massAddPayments');
        Route::post('{agreement}/add-massive-payments', [AgreementPaymentController::class, 'storeAddPayments']);
        Route::get('{agreement}/edit-payment/{payment}', [AgreementPaymentController::class, 'edit'])
            ->name('editAgrPayment');
        Route::post('{agreement}/edit-payment/{payment}', [AgreementPaymentController::class, 'update']);
        Route::post('{agreement}/delete-payments', [AgreementPaymentController::class, 'massDeletePayments'])
            ->name('massDeletePayments');
        Route::get('{agreement}/movetoreal/{payment}', [AgreementPaymentController::class, 'toRealPayments'])
            ->name('movePaymentToReal');
        Route::match(['get', 'post'], '{agreement}/delete-payment/{payment}', [AgreementPaymentController::class, 'delete'])
            ->name('deleteAgrPayment');
//              Real payments
        Route::get('{agreement}/add-real-payment', [RealPaymentController::class, 'create'])
            ->name('addRealPayment');
        Route::post('{agreement}/add-real-payment', [RealPaymentController::class, 'store']);
        Route::get('{agreement}/edit-real-payment/{payment}', [RealPaymentController::class, 'edit'])
            ->name('editRealPayment');
        Route::post('{agreement}/edit-real-payment/{payment}', [RealPaymentController::class, 'update']);
        Route::match(['get', 'post'], '{agreement}/delete-real-payment/{payment}', [RealPaymentController::class, 'delete'])
            ->name('deleteRealPayment');

        Route::group(['prefix' => 'notes'],
            function () {
                Route::get('add/{agreement}', [AgreementNoteController::class, 'create'])
                    ->name('addAgreementNote');
                Route::post('add/{agreement}', [AgreementNoteController::class, 'store']);
                Route::get('edit/{agreementNote}', [AgreementNoteController::class, 'edit'])
                    ->name('editAgreementNote');
                Route::post('edit/{agreementNote}', [AgreementNoteController::class, 'update']);
                Route::get('delete/{agreementNote}', [AgreementNoteController::class, 'erase'])
                    ->name('deleteAgreementNote');

            });


    });
