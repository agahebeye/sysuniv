<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RegisteredUserController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users/create', [RegisteredUserController::class, 'create'])
        ->name('users.create');

    Route::post('users/store', [RegisteredUserController::class, 'store'])->name('users.store');
});
