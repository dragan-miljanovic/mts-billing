<?php

use App\Http\Controllers\CallChargeController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/import', [ImportController::class, 'import'])->name('import');
Route::get('/pdf', [PdfController::class, 'generate'])->name('generate.pdf');

Route::resource('call-charges', CallChargeController::class)->only(['index', 'show', 'destroy']);
Route::resource('confirmations', ConfirmationController::class)->only(['index', 'show', 'destroy']);
