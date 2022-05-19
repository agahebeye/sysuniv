<?php

use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('students')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/store', [StudentController::class, 'store'])->name('students.store');
        Route::get('{student}', [StudentController::class, 'show'])->name('students.show');
        Route::get('{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('{student}/update', [StudentController::class, 'update'])->name('students.update');
        Route::delete('{student}/delete', [StudentController::class, 'destroy'])->name('students.destroy');
    });
