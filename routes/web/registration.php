<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::prefix('registrations')
->middleware(['auth', 'role:university'])->group(function() {
    Route::get('/create', [RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('/{student}/store', [RegistrationController::class, 'store'])->name('registrations.store');
});