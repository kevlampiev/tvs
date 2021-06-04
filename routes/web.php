<?php

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
//
//Route::get('/', function () {
//    return view('welcome');
//})->middleware('auth');

Route::group([
    'prefix' => 'admin',
    'middleware' => 'is.admin'
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
            'prefix' => 'vehicles'
        ],
            function () {
                Route::get('/', [\App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('admin.vehicles');
                Route::match(['post', 'get'], 'add', [\App\Http\Controllers\Admin\VehicleController::class, 'addVehicle'])->name('admin.addVehicle');
                Route::match(['post', 'get'], '{vehicle}/edit', [\App\Http\Controllers\Admin\VehicleController::class, 'editVehicle'])->name('admin.editVehicle');
                Route::match(['post', 'get'], '{vehicle}/delete', [\App\Http\Controllers\Admin\VehicleController::class, 'deleteVehicle'])->name('admin.deleteVehicle');
                Route::get( '{vehicle}/summary', [\App\Http\Controllers\Admin\VehicleController::class, 'vehicleSummary'])->name('admin.vehicleSummary');
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
                Route::get( '{agreement}/summary/{page?}', [\App\Http\Controllers\Admin\AgreementController::class, 'summary'])
                    ->name('admin.agreementSummary');
                Route::match(['get', 'post'], '{agreement}/add-vehicle', [\App\Http\Controllers\Admin\AgreementController::class, 'addVehicle'])
                    ->name('admin.agreementAddVehicle');
                Route::get( '{agreement}/detach-vehicle/{vehicle}', [\App\Http\Controllers\Admin\AgreementController::class, 'detachVehicle'])
                    ->name('admin.agreementDetachVehicle');
                Route::match(['get', 'post'], '{agreement}/add-payment', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'add'])
                    ->name('admin.addAgrPayment');
                Route::match(['get', 'post'], '{agreement}/edit-payment/{payment}', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'edit'])
                    ->name('admin.editAgrPayment');
                Route::match(['get', 'post'], '{agreement}/delete-payment/{payment}', [\App\Http\Controllers\Admin\AgreementPaymentController::class, 'delete'])
                    ->name('admin.deleteAgrPayment');

            }
        );
    }
);

//Auth::routes();
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class,'login']);
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
