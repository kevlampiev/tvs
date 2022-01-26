<?php

use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'messages'
],
    function () {
        Route::get('{message}/reply', [MessageController::class, 'createReply'])
            ->name('messageReply');
        Route::post('{message}/reply', [MessageController::class, 'store']);
        Route::get('{message}/edit', [MessageController::class, 'edit'])
            ->name('messageEdit');
        Route::post('{message}/edit', [MessageController::class, 'update']);
    }
);
