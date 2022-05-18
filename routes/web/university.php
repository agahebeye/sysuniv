<?php

use App\Http\Controllers\University\UniversityController;
use App\Http\Controllers\University\UniversityFacultyController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('universities')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [UniversityController::class, 'index'])->name('universities.index');
        Route::get('/create', [UniversityController::class, 'create'])->name('universities.create');
        Route::post('/store', [UniversityController::class, 'store'])->name('universities.store');
        Route::get('/{university}', [UniversityController::class, 'show'])->name('universities.show');
        Route::get('/{university}/edit', [UniversityController::class, 'edit'])->name('universities.edit');
        Route::put('/{university}/update', [UniversityController::class, 'update'])->name('universities.update');
        Route::delete('/{university}/destroy', [UniversityController::class, 'destroy'])->name('universities.destroy');
        Route::get('/{university}/faculties', [UniversityFacultyController::class, '__invoke'])->name('universities.faculties');
    });
