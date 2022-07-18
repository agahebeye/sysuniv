<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->get(
    '/',
    fn () =>
    request()->user()->isUniveristy
        ? to_route('registrations.create')
        : redirect(RouteServiceProvider::HOME)
);
