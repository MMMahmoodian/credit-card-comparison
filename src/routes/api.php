<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'credit-cards'], function () {
        Route::get('/', [\App\Http\Controllers\v1\CreditCardController::class, 'index']);
    });
});