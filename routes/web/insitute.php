<?php

use App\Http\Controllers\Institute\InstituteController;
use Illuminate\Support\Facades\Route;

Route::prefix('institutes')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [InstituteController::class, 'index'])->name('institutes.index');
        Route::get('/create', [InstituteController::class, 'create'])->name('institutes.create');
        Route::post('/store', [InstituteController::class, 'store'])->name('institutes.store');
        Route::get('{faculty}/edit', [InstituteController::class, 'edit'])->name('institutes.edit');
        Route::put('{faculty}/update', [InstituteController::class, 'update'])->name('institutes.update');
        Route::delete('{faculty}/delete', [InstituteController::class, 'destroy'])->name('institutes.destroy');
    });
