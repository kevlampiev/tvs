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

        Route::get('/', [AgreementController::class, 'index'])
            ->name('agreements');
        Route::get( 'add', [AgreementController::class, 'create'])
            ->name('addAgreement');
        Route::post( 'add', [AgreementController::class, 'store']);
        Route::get( '{agreement}/edit', [AgreementController::class, 'edit'])
            ->name('editAgreement');
        Route::post( '{agreement}/edit', [AgreementController::class, 'update']);
        Route::match(['post', 'get'], '{agreement}/delete', [AgreementController::class, 'delete'])
            ->name('deleteAgreement');
        Route::get('{agreement}/summary/{page?}', [AgreementController::class, 'summary'])
            ->name('agreementSummary');
        Route::match(['get', 'post'], '{agreement}/add-vehicle', [AgreementController::class, 'addVehicle'])
            ->name('agreementAddVehicle');
        Route::get('{agreement}/detach-vehicle/{vehicle}', [AgreementController::class, 'detachVehicle'])
            ->name('agreementDetachVehicle');
//                Платежи по договору
        Route::get( '{agreement}/add-payment', [AgreementPaymentController::class, 'create'])
            ->name('addAgrPayment');
        Route::post( '{agreement}/add-payment', [AgreementPaymentController::class, 'store']);
        Route::get( '{agreement}/add-massive-payments', [AgreementPaymentController::class, 'createAddPayments'])
            ->name('massAddPayments');
        Route::post( '{agreement}/add-massive-payments', [AgreementPaymentController::class, 'storeAddPayments']);
        Route::get( '{agreement}/edit-payment/{payment}', [AgreementPaymentController::class, 'edit'])
            ->name('editAgrPayment');
        Route::post( '{agreement}/edit-payment/{payment}', [AgreementPaymentController::class, 'update']);
        Route::post( '{agreement}/delete-payments', [AgreementPaymentController::class, 'massDeletePayments'])
            ->name('massDeletePayments');
        Route::get('{agreement}/movetoreal/{payment}', [AgreementPaymentController::class, 'toRealPayments'])
            ->name('movePaymentToReal');
        Route::match(['get', 'post'], '{agreement}/delete-payment/{payment}', [AgreementPaymentController::class, 'delete'])
            ->name('deleteAgrPayment');
//              Real payments
        Route::get( '{agreement}/add-real-payment', [RealPaymentController::class, 'create'])
            ->name('addRealPayment');
        Route::post( '{agreement}/add-real-payment', [RealPaymentController::class, 'store']);
        Route::get( '{agreement}/edit-real-payment/{payment}', [RealPaymentController::class, 'edit'])
            ->name('editRealPayment');
        Route::post( '{agreement}/edit-real-payment/{payment}', [RealPaymentController::class, 'update']);
        Route::match(['get', 'post'], '{agreement}/delete-real-payment/{payment}', [RealPaymentController::class, 'delete'])
            ->name('deleteRealPayment');

