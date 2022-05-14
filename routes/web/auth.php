<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedUserController;
use App\Http\Controllers\Auth\AuthenticatedUniversityController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedUserController::class, 'create'])
        ->name('login');

    Route::get('universities/login', [AuthenticatedUniversityController::class, 'create'])
        ->name('universities.login');

    Route::post('login', [AuthenticatedUserController::class, 'store']);

    Route::post('universities/login', [AuthenticatedUniversityController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedUserController::class, 'destroy'])
        ->name('logout');

    Route::post('universities/logout', [AuthenticatedUniversityController::class, 'destroy'])
        ->name('universities.logout');
});
