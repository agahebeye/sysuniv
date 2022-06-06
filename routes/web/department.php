<?php

use App\Http\Controllers\DepartementController;

Route::prefix('departments')
    ->middleware(['auth'])
    ->group(function () {
        Route::middleware('role:admin,employee')->group(function () {
            Route::get('/', [DepartementController::class, 'index'])->name('departments.index');
            Route::get('/create', [DepartementController::class, 'create'])->name('departments.create');
            Route::post('/store', [DepartementController::class, 'store'])->name('departments.store');
        });
    });
