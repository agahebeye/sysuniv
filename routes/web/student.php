<?php

use App\Http\Controllers\Student\StudentPhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Student\StudentResultController;

Route::prefix('students')
    ->middleware(['auth'])
    ->group(function () {

        Route::middleware(['role:admin,employee'])->group(function () {
            Route::get('/create', [StudentController::class, 'create'])->name('students.create');
            Route::post('/store', [StudentController::class, 'store'])->name('students.store');
            Route::get('{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
            Route::put('{student}/update', [StudentController::class, 'update'])->name('students.update');
            Route::get('{student}/photos/create', [StudentPhotoController::class, 'create'])->name('students.photos.create');
            Route::post('{student}/photos/store', [StudentPhotoController::class, 'store'])->name('students.photos.store');
        });

        Route::middleware(['role:admin,employee,university'])->group(function () {
            Route::get('/', [StudentController::class, 'index'])->name('students.index');
            Route::get('{student}', [StudentController::class, 'show'])->name('students.show');
        });

        Route::middleware(['role:university'])->group(function () {
            Route::get('{student}/results/create', [StudentResultController::class, 'create'])->name('students.results.create');
            Route::put('{student}/results/update', [StudentResultController::class, 'update'])->name('students.results.update');
        });
    });
