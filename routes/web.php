<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix'=>'admin'
],
    function() {
    Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index']);
    Route::group([
        'prefix'=>'types'
    ],
        function () {
        Route::get('/',[\App\Http\Controllers\Admin\TypesController::class,'index'])->name('admin.vehicleTypes');
        Route::match(['post', 'get'],'add',[\App\Http\Controllers\Admin\TypesController::class, 'addType'])->name('admin.addType');
        Route::match(['post', 'get'],'{type}/edit',[\App\Http\Controllers\Admin\TypesController::class, 'editType'])->name('admin.editType');
        Route::match(['post', 'get'], '{type}/delete',[\App\Http\Controllers\Admin\TypesController::class, 'deleteType'])->name('admin.deleteType');
        }
    );
}
);
