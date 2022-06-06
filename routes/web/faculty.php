<?php

use App\Http\Controllers\Faculty\FacultyDepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;

Route::prefix('faculties')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [FacultyController::class, 'index'])->name('faculties.index')->middleware('role:admin,employee,university');

        Route::middleware('role:admin,employee')->group(function () {
            Route::get('/create', [FacultyController::class, 'create'])->name('faculties.create');
            Route::post('/store', [FacultyController::class, 'store'])->name('faculties.store');
        });

        Route::middleware('role:university')->group(function() {
            Route::get('{faculty}/departemnts', [FacultyDepartmentController::class, 'index'])->name('faculties.departments.index');
            Route::get('{faculty}/departemnts/create', [FacultyDepartmentController::class, 'creae'])->name('faculties.departments.create');
            Route::post('{faculty}/departemnts/store', [FacultyDepartmentController::class, 'store'])->name('faculties.departments.store');
        });
    });
