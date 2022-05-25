<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::permanentRedirect('/', '/dashboard');

Route::middleware(['auth', 'role:admin,employee,university'])
    ->get('/dashboard', [DashboardController::class, '__invoke']);
