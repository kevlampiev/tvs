<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'users'
],
    function () {
        Route::get('/', [UsersController::class, 'index'])
            ->name('users');
        Route::match(['post', 'get'], 'add', [UsersController::class, 'add'])
            ->name('addUser');
        Route::match(['post', 'get'], '{user}/edit', [UsersController::class, 'edit'])
            ->name('editUser');
        Route::match(['post', 'get'], '{user}/delete', [UsersController::class, 'delete'])
            ->name('deleteUser');
        Route::match(['get', 'post'], '{user}/setTmpPswd', [UsersController::class, 'setTempPassword'])
            ->name('setTempPassword');
        Route::get('{user}/summary', [UsersController::class,'userSummary'])
            ->name('userSummary');
    });
