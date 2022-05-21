<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RegisteredUserController;

Route::middleware(['auth'])->group(function () {
    Route::get('users/create', [RegisteredUserController::class, 'create'])
        ->name('users.create')->middleware('role:admin');

    Route::post('users/store', [RegisteredUserController::class, 'store'])->name('users.store');
});
