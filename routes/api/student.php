<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VerifyStudentLevelController;
use App\Http\Controllers\Api\VerifyStudentRegistrationController;

Route::middleware(['auth', 'role:university'])->group(function () {
    Route::get('/students/registrations/{number}', [VerifyStudentRegistrationController::class, '__invoke'])->name('students.verify_number');
    Route::get('/students/levels/{number}/{level}', [VerifyStudentLevelController::class, '__invoke'])->name('students.verify_level');
});
