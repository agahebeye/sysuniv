<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\AuthenticatedUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedUserController::class, 'create'])
        ->name('login.create');

    Route::post('login', [AuthenticatedUserController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('request-password-reset', [PasswordResetLinkController::class, 'create'])
        ->name('password.email');

    Route::post('request-password-reset', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
        
    Route::post('logout', [AuthenticatedUserController::class, 'destroy'])
        ->name('logout');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});
