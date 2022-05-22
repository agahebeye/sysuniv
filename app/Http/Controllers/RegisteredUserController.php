<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\RegisteredUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController
{

    public function store(RegisteredUserRequest $request)
    {
        $user = User::query()->create($request->validated());

        event(new Registered($user));

        if ($user->role == UserType::UNIVERSITY) {
            $user->sendEmailVerificationNotification();
        }

        return redirect(RouteServiceProvider::HOME);
    }
}