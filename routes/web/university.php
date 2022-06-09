<?php

use App\Http\Controllers\University\UniversityPhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

Route::prefix('universities')
    ->middleware(['auth'])
    ->group(function () {
        Route::middleware(['role:admin,employee'])->group(function () {
            Route::get('/', [UniversityController::class, 'index'])->name('universities.index');
            Route::get('/create', [UniversityController::class, 'create'])->name('universities.create');
            Route::post('/store', [UniversityController::class, 'store'])->name('universities.store');
            Route::get('{university}', [UniversityController::class, 'show'])->name('universities.show');
            Route::get('{university}/edit', [UniversityController::class, 'edit'])->name('universities.edit');
            Route::put('{university}/update', [UniversityController::class, 'update'])->name('universities.update');
        });

        Route::middleware(['role:university'])
            ->group(function () {
                Route::get('{university}/photos/edit', [UniversityPhotoController::class, 'edit'])->name('universities.photos.edit');
                Route::put('{university}/photos/update', [UniversityPhotoController::class, 'update'])->name('universities.photos.update');
            });
    });
