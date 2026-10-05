<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pesanan', PesananController::class);