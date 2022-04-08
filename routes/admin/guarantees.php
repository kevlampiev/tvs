<?php

use App\Http\Controllers\Admin\GuaranteeLegalEntityController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'guarantee-le'
],
    function () {
        Route::get('{agreement}/add', [GuaranteeLegalEntityController::class, 'create'])
            ->name('addGuaranteeLE');
        Route::post('{agreement}/add', [GuaranteeLegalEntityController::class, 'store']);
        Route::get('{guarantee}/edit', [GuaranteeLegalEntityController::class, 'edit'])
            ->name('editGuaranteeLE');
        Route::post('{guarantee}/edit', [GuaranteeLegalEntityController::class, 'update']);
        Route::match(['post', 'get'],
            '{guarantee}/delete', [GuaranteeLegalEntityController::class, 'erase'])
            ->name('deleteGuaranteeLE');
    }
);
