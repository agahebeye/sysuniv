<?php

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::prefix('employees')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/store', [RegisteredUserController::class, 'store'])->name('employees.store');
    });
