<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:university'])->group(function () {
});
