<?php

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::prefix('employees')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', [EmployeeController::class, '__invoke'])->name('universities.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('universities.create');
        Route::post('/store', [RegisteredUserController::class, 'store'])->name('universities.store');
        Route::get('/{university}/edit', [EmployeeController::class, 'edit'])->name('universities.edit');
        Route::put('/{university}/update', [RegisteredUserController::class, 'update'])->name('universities.update');
        Route::delete('/{university}/destroy', [RegisteredUserController::class, 'destroy'])->name('universities.destroy');
    });
