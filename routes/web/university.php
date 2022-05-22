<?php

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

Route::prefix('universities')
    ->middleware(['auth'])
    ->group(function () {
        Route::middleware(['role:admin,employee'])->group(function () {
            Route::get('/', [UniversityController::class, '__invoke'])->name('universities.index');
            Route::get('/create', [UniversityController::class, 'create'])->name('universities.create');
            Route::post('/store', [RegisteredUserController::class, 'store'])->name('universities.store');
            Route::get('/{university}/edit', [UniversityController::class, 'edit'])->name('universities.edit');
            Route::put('/{university}/update', [RegisteredUserController::class, 'update'])->name('universities.update');
        });

        Route::delete('/{university}/destroy', [RegisteredUserController::class, 'destroy'])->name('universities.destroy')->middleware('role:admin');
    });
