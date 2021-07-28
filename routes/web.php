<?php

use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\AgreementPaymentController;
use App\Http\Controllers\Admin\AgreementTypeController;
use App\Http\Controllers\Admin\BankStatementController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CounterpartyController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InsuranceCompanyController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\InsuranceTypesController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\RealPaymentController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Auth\ExpiredPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\NearestPaymentsController;
use App\Http\Controllers\User\SettlementReportsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => 'admin',
    'middleware' => ['is.manager', 'password_expired']
],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('admin.main');
        Route::group([
            'prefix' => 'types'
        ],
            function () {
                Route::get('/', [VehicleTypeController::class, 'index'])
                    ->name('admin.vehicleTypes');
                Route::get('add', [VehicleTypeController::class, 'create'])
                    ->name('admin.addVehicleType');
                Route::post('add', [VehicleTypeController::class, 'store']);
                Route::get( '{vehicleType}/edit', [VehicleTypeController::class, 'edit'])
                    ->name('admin.editVehicleType');
                Route::post( '{vehicleType}/edit', [VehicleTypeController::class, 'update']);
                Route::match(['post', 'get'], '{vehicleType}/delete', [VehicleTypeController::class, 'erase'])
                    ->name('admin.deleteVehicleType');
            }
        );

//        Route::resource('vehicleTypes',\App\Http\Controllers\Admin\VehicleTypeController::class);
        Route::group([
            'prefix' => 'manufacturers'
        ],
            function () {
                Route::get('/', [ManufacturersController::class, 'index'])->name('admin.manufacturers');
                Route::get( 'add', [ManufacturersController::class, 'create'])
                    ->name('admin.addManufacturer');
                Route::post( 'add', [ManufacturersController::class, 'store']);
                Route::get( '{manufacturer}/edit', [ManufacturersController::class, 'edit'])
                    ->name('admin.editManufacturer');
                Route::post( '{manufacturer}/edit', [ManufacturersController::class, 'update']);
                Route::match(['post', 'get'], '{manufacturer}/delete', [ManufacturersController::class, 'destroy'])
                    ->name('admin.deleteManufacturer');
            }
        );

        Route::group([
            'prefix' => 'agrTypes'
        ],
            function () {
                Route::get('/', [AgreementTypeController::class, 'index'])
                    ->name('admin.agrTypes');
                Route::get('add', [AgreementTypeController::class, 'create'])
                    ->name('admin.addAgrType');
                Route::post('add',[AgreementTypeController::class,'store']);
                Route::get('{agrType}/edit', [AgreementTypeController::class, 'edit'])
                    ->name('admin.editAgrType');
                Route::post('{agrType}/edit', [AgreementTypeController::class, 'update']);
                Route::match(['post', 'get'],
                    '{agrType}/delete', [AgreementTypeController::class, 'destroy'])
                    ->name('admin.deleteAgrType');
            }
        );

        Route::group([
            'prefix' => 'counterparties'
        ],
            function () {
                Route::get('/', [CounterpartyController::class, 'index'])
                    ->name('admin.counterparties');
                Route::get('add', [CounterpartyController::class, 'create'])
                    ->name('admin.addCounterparty');
                Route::post('add', [CounterpartyController::class, 'store']);
                Route::get('{counterparty}/edit',[CounterpartyController::class,'edit'])
                    ->name('admin.editCounterparty');
                Route::post('{counterparty}/edit',[CounterpartyController::class,'update']);
                Route::match(['post', 'get'],
                    '{counterparty}/delete', [CounterpartyController::class, 'destroy'])
                    ->name('admin.deleteCounterparty');
            }
        );

        Route::group([
            'prefix' => 'companies'
        ],
            function () {
                Route::get('/', [CompanyController::class, 'index'])
                    ->name('admin.companies');
                Route::get('add', [CompanyController::class, 'create'])
                    ->name('admin.addCompany');
                Route::post('add',[CompanyController::class,'store']);
                Route::get('{company}/edit', [CompanyController::class, 'edit'])
                    ->name('admin.editCompany');
                Route::post('{company}/edit', [CompanyController::class, 'update']);
                Route::match(['post', 'get'],
                    '{company}/delete', [CompanyController::class, 'destroy'])
                    ->name('admin.deleteCompany');
            }
        );

        Route::group([
            'prefix' => 'insurance-companies'
        ],
            function () {
                Route::get('/', [InsuranceCompanyController::class, 'index'])
                    ->name('admin.insuranceCompanies');
                Route::get('add', [InsuranceCompanyController::class, 'create'])
                    ->name('admin.addInsuranceCompany');
                Route::post('add', [InsuranceCompanyController::class, 'store']);
                Route::get('{insuranceCompany}/edit', [InsuranceCompanyController::class, 'edit'])
                    ->name('admin.editInsuranceCompany');
                Route::post('{insuranceCompany}/edit', [InsuranceCompanyController::class, 'update'])
                    ->name('admin.editInsuranceCompany');
                Route::match(['post', 'get'],
                    '{insuranceCompany}/delete', [InsuranceCompanyController::class, 'destroy'])
                    ->name('admin.deleteInsuranceCompany');
            }
        );

        Route::group([
            'prefix' => 'insurance-types'
        ],
            function () {
                Route::get('/', [InsuranceTypesController::class, 'index'])
                    ->name('admin.insuranceTypes');
                Route::get('add', [InsuranceTypesController::class, 'create'])
                    ->name('admin.addInsuranceType');
                Route::post('add', [InsuranceTypesController::class, 'store']);
                Route::get('{insuranceType}/edit', [InsuranceTypesController::class, 'edit'])
                    ->name('admin.editInsuranceType');
                Route::post('{insuranceType}/edit', [InsuranceTypesController::class, 'update']);
                Route::match(['post', 'get'],
                    '{insuranceType}/delete', [InsuranceTypesController::class, 'destroy'])
                    ->name('admin.deleteInsuranceType');
            }
        );


        Route::group([
            'prefix' => 'insurances'
        ],
            function () {
                Route::get('/', [InsuranceController::class, 'index'])
                    ->name('admin.insurances');
                Route::match(['post', 'get'],
                    'add/{vehicle?}', [InsuranceController::class, 'add'])
                    ->name('admin.addInsurance');
                Route::match(['post', 'get'],
                    '{insurance}/edit', [InsuranceController::class, 'edit'])
                    ->name('admin.editInsurance');
                Route::match(['post', 'get'],
                    '{insurance}/delete', [InsuranceController::class, 'delete'])
                    ->name('admin.deleteInsurance');
            }
        );


        Route::group([
            'prefix' => 'vehicles'
        ],
            function () {
                Route::get('/', [VehicleController::class, 'index'])->name('admin.vehicles');
                Route::match(['post', 'get'], 'add', [VehicleController::class, 'addVehicle'])->name('admin.addVehicle');
                Route::match(['post', 'get'], '{vehicle}/edit', [VehicleController::class, 'editVehicle'])->name('admin.editVehicle');
                Route::match(['post', 'get'], '{vehicle}/delete', [VehicleController::class, 'deleteVehicle'])->name('admin.deleteVehicle');
                Route::get('{vehicle}/summary/{page?}', [VehicleController::class, 'vehicleSummary'])->name('admin.vehicleSummary');
                Route::match(['get','post'], '{vehicle}/attach-agreement', [VehicleController::class, 'attachAgreement'])
                    ->name('admin.attachAgreement');
                Route::get('{vehicle}/detach-agreement/{agreement}', [VehicleController::class, 'detachAgreement'])
                    ->name('admin.detachAgreement');

            }
        );

        Route::group([
            'prefix' => 'agreements'
        ],
            function () {
                Route::get('/', [AgreementController::class, 'index'])
                    ->name('admin.agreements');
                Route::match(['post', 'get'], 'add', [AgreementController::class, 'add'])
                    ->name('admin.addAgreement');
                Route::match(['post', 'get'], '{agreement}/edit', [AgreementController::class, 'edit'])
                    ->name('admin.editAgreement');
                Route::match(['post', 'get'], '{agreement}/delete', [AgreementController::class, 'delete'])
                    ->name('admin.deleteAgreement');
                Route::get('{agreement}/summary/{page?}', [AgreementController::class, 'summary'])
                    ->name('admin.agreementSummary');
                Route::match(['get', 'post'], '{agreement}/add-vehicle', [AgreementController::class, 'addVehicle'])
                    ->name('admin.agreementAddVehicle');
                Route::get('{agreement}/detach-vehicle/{vehicle}', [AgreementController::class, 'detachVehicle'])
                    ->name('admin.agreementDetachVehicle');
                Route::match(['get', 'post'], '{agreement}/add-payment', [AgreementPaymentController::class, 'add'])
                    ->name('admin.addAgrPayment');
                Route::match(['get', 'post'], '{agreement}/add-massive-payments', [AgreementPaymentController::class, 'massAddPayments'])
                    ->name('admin.massAddPayments');
                Route::match(['get', 'post'], '{agreement}/edit-payment/{payment}', [AgreementPaymentController::class, 'edit'])
                    ->name('admin.editAgrPayment');
                Route::match(['get', 'post'], '{agreement}/cancel-payments', [AgreementPaymentController::class, 'cancelPayments'])
                    ->name('admin.massCancelPayments');
                Route::post( '{agreement}/delete-payments', [AgreementPaymentController::class, 'massDeletePayments'])
                    ->name('admin.massDeletePayments');
                Route::get('{agreement}/movetoreal/{payment}', [AgreementPaymentController::class, 'toRealPayments'])
                    ->name('admin.movePaymentToReal');
                Route::match(['get', 'post'], '{agreement}/delete-payment/{payment}', [AgreementPaymentController::class, 'delete'])
                    ->name('admin.deleteAgrPayment');
                Route::match(['get', 'post'], '{agreement}/add-real-payment', [RealPaymentController::class, 'add'])
                    ->name('admin.addRealPayment');
                Route::match(['get', 'post'], '{agreement}/edit-real-payment/{payment}', [RealPaymentController::class, 'edit'])
                    ->name('admin.editRealPayment');
                Route::match(['get', 'post'], '{agreement}/delete-real-payment/{payment}', [RealPaymentController::class, 'delete'])
                    ->name('admin.deleteRealPayment');
            }



        );

        Route::group([
            'prefix' => 'users',
            'middleware' => 'is.admin'
        ],
            function () {
                Route::get('/', [UsersController::class, 'index'])
                    ->name('admin.users');
                Route::match(['post', 'get'], 'add', [UsersController::class, 'add'])
                    ->name('admin.addUser');
                Route::match(['post', 'get'], '{user}/edit', [UsersController::class, 'edit'])
                    ->name('admin.editUser');
                Route::match(['post', 'get'], '{user}/delete', [UsersController::class, 'delete'])
                    ->name('admin.deleteUser');
                Route::match(['get', 'post'], '{user}/setTmpPswd', [UsersController::class, 'setTempPassword'])
                    ->name('admin.setTempPassword');
            }
        );

        Route::group([
            'prefix' => 'actions',
            'middleware' => 'is.admin'
        ],
            function () {
                Route::get('load-bank-statement', [BankStatementController::class, 'index'])
                    ->name('admin.loadBankStatement');
                Route::post('pre-load-file', [BankStatementController::class,'preLoadFile'])
                    ->name('admin.preProcessBankStatement');
                Route::post('transfer-to-real-payments', [BankStatementController::class,'transferToRealPayments'])
                    ->name('admin.transferToRealPayments');
                Route::match(['get','post'],'attach_agreement_to_pbs/{bankStatementPosition}',
                    [BankStatementController::class, 'attachAgreement'])
                    ->name('admin.attachAgrToBS');
                Route::post('detach_agreement_to_pbs/{bankStatementPosition}',
                    [BankStatementController::class, 'detachAgreement'])
                    ->name('admin.detachAgrToBS');
                Route::post('delete_pbs',
                    [BankStatementController::class, 'deleteBankStatemets'])
                    ->name('admin.clearBankStatements');
            }
        );

    }
);

Route::group([
    'prefix' => 'user',
    'middleware' => ['auth', 'password_expired']
],
    function () {
        Route::get('/settlements/all-v1',
            [SettlementReportsController::class, 'showBigSettlementReport'])
            ->name('user.allSettlements');
        Route::get('/settlements/all-v2',
            [SettlementReportsController::class, 'showBigSettlement2Report'])
            ->name('user.allSettlements2');
        Route::get('/settlements/nearest-payments',
            [NearestPaymentsController::class,'showAllAgr'])
            ->name('user.nearestPayments');
        Route::get('/settlements/{id}',
            [SettlementReportsController::class, 'showAgrSettlementReport'])
            ->name('user.agreementSettlements');
    });

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/expired', [ExpiredPasswordController::class, 'expired'])
    ->name('password.expired');
Route::post('password/expired', [ExpiredPasswordController::class, 'postExpired'])
    ->name('password.postExpired');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'password_expired']);

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth','password_expired']);

