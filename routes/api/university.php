<?php

use Illuminate\Support\Facades\Route;

Route::prefix('universities')
    ->middleware(['auth'])
    ->get('/', fn () => User::university()->get(['name']))->name('api.universities.index');
