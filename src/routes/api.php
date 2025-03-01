<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'credit-cards'], function () {
        Route::get('/', [\App\Http\Controllers\v1\CreditCardController::class, 'index']);
    });

    Route::group(['prefix' => 'back-office'], function () {
        Route::post('/edits', [\App\Http\Controllers\v1\BackOfficeController::class, 'storeEdit']);
    });
});