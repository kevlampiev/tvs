<?php

use App\Http\Controllers\Auth\ExpiredPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\InsurancesController;
use App\Http\Controllers\User\InsurancesToRenewalController;
use App\Http\Controllers\User\NearestPaymentsController;
use App\Http\Controllers\User\SettlementReportsController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user',
    'middleware' => ['auth', 'password_expired']
],
    function () {
        Route::get('profile', [UserProfileController::class, 'edit'])
            ->name('user.profileEdit');
        Route::post('profile', [UserProfileController::class, 'update']);

        Route::get('/filepreview/insurance-policy', [\App\Http\Controllers\User\FileDownloadController::class, 'previewInsurance'])
            ->name('user.filePreview');

    });

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/expired', [ExpiredPasswordController::class, 'expired'])
    ->name('password.expired');
Route::post('password/expired', [ExpiredPasswordController::class, 'postExpired'])
    ->name('password.postExpired');

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'password_expired']);
Route::get('notification/{id}', [HomeController::class, 'readNotification'])->name('readNotification')->middleware(['auth', 'password_expired']);
Route::get('notifications/markAllAsRead', [HomeController::class, 'markAllNotificationsAsRead'])->name('markAllNotificationsAsRead')->middleware(['auth', 'password_expired']);
