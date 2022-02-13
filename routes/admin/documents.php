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
        //Не понял в чем тут прикол. Зачем такой специализированный роут на редактирование
        Route::get('edit/vehicle/{document}', [DocumentController::class, 'edit'])
            ->name('editVehicleDocument');
        Route::post('edit/vehicle/{document}', [DocumentController::class, 'update']);

        Route::get('{document}/edit', [DocumentController::class, 'edit'])
            ->name('editDocument');
        Route::post('{document}/edit', [DocumentController::class, 'update']);

        Route::get('add/agreement/{agreement}', [DocumentController::class, 'create'])
            ->name('addAgreementDocument');
        Route::post('add/agreement/{agreement}', [DocumentController::class, 'store']);
        //Не понял в чем тут прикол. Зачем такой специализированный роут как и в случае с vehicle
        Route::get('edit/agreement/{document}', [DocumentController::class, 'edit'])
            ->name('editAgreementDocument');
        Route::post('edit/agreement/{document}', [DocumentController::class, 'update']);

        Route::get('delete/{document}', [DocumentController::class, 'delete'])
            ->name('deleteDocument');
        Route::get('/preview/{document}', [DocumentController::class, 'preview'])
            ->name('documentPreview');
    });
