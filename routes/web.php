<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManufacturersController;

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
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.main');
        Route::group([
            'prefix' => 'types'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\TypesController::class, 'index'])->name('admin.vehicleTypes');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\TypesController::class, 'addType'])->name('admin.addType');
                Route::match(['post', 'get'], '{type}/edit', [\App\Http\Controllers\Admin\TypesController::class, 'editType'])->name('admin.editType');
                Route::match(['post', 'get'], '{type}/delete', [\App\Http\Controllers\Admin\TypesController::class, 'deleteType'])->name('admin.deleteType');
            }
        );
        Route::group([
            'prefix' => 'manufacturers'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\ManufacturersController::class, 'index'])->name('admin.manufacturers');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\ManufacturersController::class, 'addManufacturer'])->name('admin.addManufacturer');
                Route::match(['post', 'get'], '{manufacturer}/edit', [\App\Http\Controllers\Admin\ManufacturersController::class, 'editManufacturer'])->name('admin.editManufacturer');
                Route::match(['post', 'get'], '{manufacturer}/delete', [\App\Http\Controllers\Admin\ManufacturersController::class, 'deleteManufacturer'])->name('admin.deleteManufacturer');
            }
        );

        Route::group([
            'prefix' => 'agrTypes'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'index'])
                    ->name('admin.agrTypes');
                Route::match(['post', 'get'],
                    'add', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'addType'])
                    ->name('admin.addAgrType');
                Route::match(['post', 'get'],
                    '{agrType}/edit', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'editType'])
                    ->name('admin.editAgrType');
                Route::match(['post', 'get'],
                    '{agrType}/delete', [\App\Http\Controllers\Admin\AgreementTypeController::class, 'deleteType'])
                    ->name('admin.deleteAgrType');
            }
        );

        Route::group([
            'prefix' => 'counterparties'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\CounterpartyController::class, 'index'])
                    ->name('admin.counterparties');
                Route::match(['post', 'get'],
                    'add', [\App\Http\Controllers\Admin\CounterpartyController::class, 'addCounterparty'])
                    ->name('admin.addCounterparty');
                Route::match(['post', 'get'],
                    '{counterparty}/edit', [\App\Http\Controllers\Admin\CounterpartyController::class, 'editCounterparty'])
                    ->name('admin.editCounterparty');
                Route::match(['post', 'get'],
                    '{counterparty}/delete', [\App\Http\Controllers\Admin\CounterpartyController::class, 'deleteCounterparty'])
                    ->name('admin.deleteCounterparty');
            }
        );

        Route::group([
            'prefix' => 'companies'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\CompanyController::class, 'index'])
                    ->name('admin.companies');
                Route::match(['post', 'get'],
                    'add', [\App\Http\Controllers\Admin\CompanyController::class, 'addCompany'])
                    ->name('admin.addCompany');
                Route::match(['post', 'get'],
                    '{company}/edit', [\App\Http\Controllers\Admin\CompanyController::class, 'editCompany'])
                    ->name('admin.editCompany');
                Route::match(['post', 'get'],
                    '{company}/delete', [\App\Http\Controllers\Admin\CompanyController::class, 'deleteCompany'])
                    ->name('admin.deleteCompany');
            }
        );

        Route::group([
            'prefix' => 'insurance-companies'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\InsuranceCompanyController::class, 'index'])
                    ->name('admin.insuranceCompanies');
                Route::match(['post', 'get'],
                    'add', [\App\Http\Controllers\Admin\InsuranceCompanyController::class, 'add'])
                    ->name('admin.addInsuranceCompany');
                Route::match(['post', 'get'],
                    '{company}/edit', [\App\Http\Controllers\Admin\InsuranceCompanyController::class, 'edit'])
                    ->name('admin.editInsuranceCompany');
                Route::match(['post', 'get'],
                    '{company}/delete', [\App\Http\Controllers\Admin\InsuranceCompanyController::class, 'delete'])
                    ->name('admin.deleteInsuranceCompany');
            }
        );

        Route::group([
            'prefix' => 'vehicles'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('admin.vehicles');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\VehicleController::class, 'addVehicle'])->name('admin.addVehicle');
                Route::match(['post', 'get'], '{vehicle}/edit', [\App\Http\Controllers\Admin\VehicleController::class, 'editVehicle'])->name('admin.editVehicle');
                Route::match(['post', 'get'], '{vehicle}/delete', [\App\Http\Controllers\Admin\VehicleController::class, 'deleteVehicle'])->name('admin.deleteVehicle');
                Route::get('{vehicle}/summary/{page?}', [\App\Http\Controllers\Admin\VehicleController::class, 'vehicleSummary'])->name('admin.vehicleSummary');
                Route::match(['get','post'], '{vehicle}/attach-agreement', [\App\Http\Controllers\Admin\VehicleController::class, 'attachAgreement'])
                    ->name('admin.attachAgreement');
                Route::get('{vehicle}/detach-agreement/{agreement}', [\App\Http\Controllers\Admin\VehicleController::class, 'detachAgreement'])
                    ->name('admin.detachAgreement');

            }
        );

        Route::group([
            'prefix' => 'agreements'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\AgreementController::class, 'index'])
                    ->name('admin.agreements');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\AgreementController::class, 'add'])
                    ->name('admin.addAgreement');
                Route::match(['post', 'get'], '{agreement}/edit', [\App\Http\Controllers\Admin\AgreementController::class, 'edit'])
                    ->name('admin.editAgreement');
                Route::match(['post', 'get'], '{agreement}/delete', [\App\Http\Controllers\Admin\AgreementController::class, 'delete'])
                    ->name('admin.deleteAgreement');
                Route::get('{agreement}/summary/{page?}', [\App\Http\Controllers\Admin\AgreementController::class, 'summary'])
                    ->name('admin.agreementSummary');
                Route::match(['get', 'post'], '{agreement}/add-vehicle', [\App\Http\Controllers\Admin\AgreementController::class, 'addVehicle'])
                    ->name('admin.agreementAddVehicle');
                Route::get('{agreement}/detach-vehicle/{vehicle}', [\App\Http\Controllers\Admin\AgreementController::class, 'detachVehicle'])
                    ->name('admin.agreementDetachVehicle');
                Route::match(['get', 'post'], '{agreement}/add-payment', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'add'])
                    ->name('admin.addAgrPayment');
                Route::match(['get', 'post'], '{agreement}/add-massive-payments', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'massAddPayments'])
                    ->name('admin.massAddPayments');
                Route::match(['get', 'post'], '{agreement}/edit-payment/{payment}', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'edit'])
                    ->name('admin.editAgrPayment');
                Route::match(['get', 'post'], '{agreement}/cancel-payments', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'cancelPayments'])
                    ->name('admin.massCancelPayments');
                Route::get('{agreement}/movetoreal/{payment}', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'toRealPayments'])
                    ->name('admin.movePaymentToReal');
                Route::match(['get', 'post'], '{agreement}/delete-payment/{payment}', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'delete'])
                    ->name('admin.deleteAgrPayment');
                Route::match(['get', 'post'], '{agreement}/add-real-payment', [\App\Http\Controllers\Admin\RealPaymentController::class, 'add'])
                    ->name('admin.addRealPayment');
                Route::match(['get', 'post'], '{agreement}/edit-real-payment/{payment}', [\App\Http\Controllers\Admin\RealPaymentController::class, 'edit'])
                    ->name('admin.editRealPayment');
                Route::match(['get', 'post'], '{agreement}/delete-real-payment/{payment}', [\App\Http\Controllers\Admin\RealPaymentController::class, 'delete'])
                    ->name('admin.deleteRealPayment');

            }
        );

        Route::group([
            'prefix' => 'users',
            'middleware' => 'is.admin'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\UsersController::class, 'index'])
                    ->name('admin.users');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\UsersController::class, 'add'])
                    ->name('admin.addUser');
                Route::match(['post', 'get'], '{user}/edit', [\App\Http\Controllers\Admin\UsersController::class, 'edit'])
                    ->name('admin.editUser');
                Route::match(['post', 'get'], '{user}/delete', [\App\Http\Controllers\Admin\UsersController::class, 'delete'])
                    ->name('admin.deleteUser');
                Route::match(['get', 'post'], '{user}/setTmpPswd', [\App\Http\Controllers\Admin\UsersController::class, 'setTempPassword'])
                    ->name('admin.setTempPassword');
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
            [\App\Http\Controllers\User\SettlementReportsController::class, 'showBigSettlementReport'])
            ->name('user.allSettlements');
        Route::get('/settlements/all-v2',
            [\App\Http\Controllers\User\SettlementReportsController::class, 'showBigSettlement2Report'])
            ->name('user.allSettlements2');
        Route::get('/settlements/nearest-payments',
            [\App\Http\Controllers\User\NearestPaymentsController::class,'showAllAgr'])
            ->name('user.nearestPayments');
        Route::get('/settlements/{agreement}',
            [\App\Http\Controllers\User\SettlementReportsController::class, 'showAgrSettlementReport'])
            ->name('user.agreementSettlements');
    });

//Auth::routes();
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('password/expired', [\App\Http\Controllers\Auth\ExpiredPasswordController::class, 'expired'])
    ->name('password.expired');
Route::post('password/expired', [\App\Http\Controllers\Auth\ExpiredPasswordController::class, 'postExpired'])
    ->name('password.postExpired');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'password_expired']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth','password_expired']);

