<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Employee\EmployeePhotoController;

Route::prefix('employees')
    ->middleware(['auth'])
    ->group(function () {
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
            Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
            Route::post('/store', [EmployeeController::class, 'store'])->name('employees.store');
        });

        Route::middleware(['role:employee'])
            ->group(function () {
                Route::get('{employee}/photos/edit', [EmployeePhotoController::class, 'edit'])->name('employees.photos.edit');
                Route::put('{employee}/photos/update', [EmployeePhotoController::class, 'update'])->name('employees.photos.update');
            });
    });
