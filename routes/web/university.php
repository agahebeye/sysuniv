<?php

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

Route::prefix('universities')
    ->middleware(['auth'])
    ->group(function () {
        Route::middleware(['role:admin,employee'])->group(function () {
            Route::get('/', [UniversityController::class, 'index'])->name('universities.index');
            Route::get('/create', [UniversityController::class, 'create'])->name('universities.create');
            Route::post('/store', [UniversityController::class, 'store'])->name('universities.store');
        });
    });