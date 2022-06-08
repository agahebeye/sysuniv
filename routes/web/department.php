<?php

use App\Http\Controllers\DepartmentController;

Route::prefix('departments')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->middleware('role:admin,employee,university')->name('departments.index');

        Route::middleware('role:admin,employee')->group(function () {
            Route::get('/create', [DepartmentController::class, 'create'])->name('departments.create');
            Route::post('/store', [DepartmentController::class, 'store'])->name('departments.store');
        });
    });
