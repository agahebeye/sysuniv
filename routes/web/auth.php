<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedUserController;
use App\Http\Controllers\Auth\AuthenticatedUniversityController;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedUserController::class, 'create'])
        ->name('login')->name('login.create');

    Route::post('login', [AuthenticatedUserController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
       Route::post('logout', [AuthenticatedUserController::class, 'destroy'])
        ->name('logout');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});
