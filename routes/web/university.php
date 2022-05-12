<?php

use App\Http\Controllers\University\UniversityController;
use Illuminate\Support\Facades\Route;

Route::prefix('universities')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [UniversityController::class, 'index'])->name('universities.index');
        Route::get('/{university}/edit', [UniversityController::class, 'edit'])->name('universities.edit');
    });
