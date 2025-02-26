<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));
Route::get('/credit-cards', fn() => view('credit-cards.index'));
