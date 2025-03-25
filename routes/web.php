<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/import', [ImportController::class, 'import'])->name('import');
