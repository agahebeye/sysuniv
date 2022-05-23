<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::prefix('students')
    ->middleware(['auth'])
    ->group(function () {

        Route::middleware(['role:admin,employee'])->group(function () {
            Route::get('/create', [StudentController::class, 'create'])->name('students.create');
            Route::post('/store', [StudentController::class, 'store'])->name('students.store');
            Route::get('{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
            Route::put('{student}/update', [StudentController::class, 'update'])->name('students.update');
        });

        Route::middleware(['role:admin,employee,university'])->group(function () {
            Route::get('/', [StudentController::class, 'index'])->name('students.index');
            Route::get('{student}', [StudentController::class, 'show'])->name('students.show');
        });
    });
