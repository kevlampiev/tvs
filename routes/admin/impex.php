<?php

use App\Http\Controllers\Admin\BankStatementController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'import',
    'middleware' => 'is.admin'
],
    function () {
        Route::get('bank-statement', [BankStatementController::class, 'index'])
            ->name('loadBankStatement');
        Route::post('pre-load-file', [BankStatementController::class, 'preLoadFile'])
            ->name('preProcessBankStatement');
        Route::post('transfer-to-real-payments', [BankStatementController::class, 'transferToRealPayments'])
            ->name('transferToRealPayments');
        Route::match(['get', 'post'], 'attach_agreement_to_pbs/{bankStatementPosition}',
            [BankStatementController::class, 'attachAgreement'])
            ->name('attachAgrToBS');
        Route::get('detach_agreement_to_pbs/{bankStatementPosition}',
            [BankStatementController::class, 'detachAgreement'])
            ->name('detachAgrToBS');
        Route::post('delete_pbs',
            [BankStatementController::class, 'deleteBankStatemets'])
            ->name('clearBankStatements');
    });


Route::group([
    'prefix' => 'export',
    'middleware' => 'is.admin'
],
    function ()
    {
    Route::get('payments',
        [\App\Http\Controllers\Admin\ExportPaymentsController::class,'export'])
        ->name('exportAgreementPayments');
    }
    );
