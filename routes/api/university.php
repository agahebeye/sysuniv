<?php

use Illuminate\Support\Facades\Route;

Route::get('/universities', fn () => User::university()->get(['name']))->name('api.universities.index');
