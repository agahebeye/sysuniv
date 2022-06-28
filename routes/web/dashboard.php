<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Notifications\UniversityStored;
use App\Notifications\UniversityRegistered;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role:admin,employee,university'])
    ->get('/', [DashboardController::class, '__invoke']);

Route::get('/notification', function () {
    $university = User::university()->latest()->first();
    return (new UniversityStored(rawPassword: 'password'))
        ->toMail($university);
});

Route::get('/notification-1', function () {
    $university = User::university()->latest()->first();
    return (new UniversityRegistered(password: 'password'))
        ->toMail($university);
});
