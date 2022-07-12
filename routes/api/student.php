<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VerifyStudentController;

Route::/*middleware(['auth:sanctum', 'role:university'])
    ->*/get(
        '/students/verify/{registration_number}',
        [VerifyStudentController::class, '__invoke']
    )->name('students.verify');
