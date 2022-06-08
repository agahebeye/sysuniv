<?php

use App\Http\Controllers\Institute\InstituteDepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstituteController;

Route::prefix('institutes')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [InstituteController::class, 'index'])->name('institutes.index')->middleware('role:admin,employee,university');

        Route::middleware('role:admin,employee')->group(function () {
            Route::get('/create', [InstituteController::class, 'create'])->name('institutes.create');
            Route::post('/store', [InstituteController::class, 'store'])->name('institutes.store');
        });
    });
