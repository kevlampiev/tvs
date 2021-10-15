<?php

use App\Http\Controllers\Admin\DocumentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'documents'
],
    function () {
        Route::get('add/vehicle/{vehicle}', [DocumentController::class, 'create'])
            ->name('addVehicleDocument');
        Route::post('add/vehicle/{vehicle}', [DocumentController::class, 'store']);
        Route::get('edit/vehicle/{document}', [DocumentController::class, 'edit'])
            ->name('editVehicleDocument');
        Route::post('edit/vehicle/{document}', [DocumentController::class, 'update']);

        Route::get('add/agreement/{agreement}', [DocumentController::class, 'create'])
            ->name('addAgreementDocument');
        Route::post('add/agreement/{agreement}', [DocumentController::class, 'store']);
        Route::get('edit/agreement/{document}', [DocumentController::class, 'edit'])
            ->name('editAgreementDocument');
        Route::post('edit/agreement/{document}', [DocumentController::class, 'update']);

        Route::get('delete/{document}', [DocumentController::class, 'delete'])
            ->name('deleteDocument');
        Route::get('/preview/{document}', [DocumentController::class, 'preview'])
            ->name('documentPreview');
    });
