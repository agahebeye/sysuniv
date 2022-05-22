<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisteredUserController
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('users/create');
    }

    public function store(RegisteredUserRequest $request)
    {
       
        $user = User::query()->create($request->validated());

        event(new Registered($user));

        if ($user->role == UserType::UNIVERSITY) {
            $user->sendEmailVerificationNotification();
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function edit(User $user): \Inertia\Response
    {
        return Inertia::render('universities/edit', [
            'user' => $user
        ]);
    }

    public function update(RegisteredUserRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        $user->update($data);

        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $user->delete();
        return redirect(RouteServiceProvider::HOME);
    }
}