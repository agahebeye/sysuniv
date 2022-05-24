<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentRegistrationNumberController;

Route::prefix('api')
    ->middleware(['auth', 'role:university'])->group(function () {
        Route::get('students/registration-number/{number}', [StudentRegistrationNumberController::class, '__invoke']);
    });
