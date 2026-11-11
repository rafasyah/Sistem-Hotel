<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Models\pesanan;

Route::get('/', function () {
    $pesanans = pesanan::orderBy('id', 'desc')->get();
    return view('welcome', compact('pesanans'));
})->name('home');

Route::resource('pesanan', PesananController::class);