<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::prefix('api')
    ->middleware(['auth', 'role:university'])->group(function () {
        Route::get('students/registrations/{number}', [StudentController::class, 'verifyRegistrationNumber'])->name('students.registrations.number');
    });
