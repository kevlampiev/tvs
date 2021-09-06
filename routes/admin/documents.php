<?php

use App\Http\Controllers\Admin\DocumentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'documents'
],
    function () {
        Route::get('add/{vehicle}', [DocumentController::class, 'create'])
            ->name('addVehicleDocument');
        Route::post('add/{vehicle}', [DocumentController::class, 'store']);
        Route::get('edit/{document}', [DocumentController::class, 'edit'])
            ->name('editVehicleDocument');
        Route::post('edit/{document}', [DocumentController::class, 'update']);
        Route::get('delete/{document}', [DocumentController::class, 'erase'])
            ->name('deleteDocument');
        Route::get('/preview/{document}', [DocumentController::class, 'preview'])
            ->name('documentPreview');
    });
