<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/import', [ImportController::class, 'import'])->name('import');
Route::get('/pdf', [PdfController::class, 'generate'])->name('generate.pdf');
