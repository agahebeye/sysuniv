<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstituteController;

Route::prefix('institutes')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [InstituteController::class, 'index'])->name('institutes.index');
        Route::get('/create', [InstituteController::class, 'create'])->name('institutes.create');
        Route::post('/store', [InstituteController::class, 'store'])->name('institutes.store');
    });
