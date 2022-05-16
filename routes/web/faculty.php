<?php

use App\Http\Controllers\Faculty\FacultyController;
use Illuminate\Support\Facades\Route;

Route::prefix('faculties')
->middleware(['auth'])
->group(function() {
    Route::get('/', [FacultyController::class, 'index'])->name('faculties.index');
    Route::get('/create', [FacultyController::class, 'create'])->name('faculties.create');
    Route::post('/store', [FacultyController::class, 'store'])->name('faculties.store');
    Route::delete('{faculty}/delete', [FacultyController::class, 'destroy'])->name('faculties.destroy');
});