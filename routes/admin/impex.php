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
