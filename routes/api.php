<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VerifyStudentController;

Route::prefix('api')
    ->middleware(['auth', 'role:university'])->group(function () {
        Route::get('students/verify/{registration_number}', [VerifyStudentController::class, '__invoke'])->name('students.verify');
    });
