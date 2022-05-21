<?php

namespace App\Http\Controllers\University;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use App\Models\University;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UniversityController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('universities/index', [
            'universities' => User::university()->with(['photo'])->get()
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('universities/create');
    }

    public function store(RegisteredUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        $university = User::query()->create($data);
        $university->sendEmailVerificationNotification();

        return redirect(RouteServiceProvider::HOME);
    }

    public function edit(User $university): \Inertia\Response
    {
        return Inertia::render('universities/edit', [
            'university' => $university
        ]);
    }

    public function update(RegisteredUserRequest $request, User $university): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        $university->update($data);

        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(User $university): \Illuminate\Http\RedirectResponse
    {
        $university->delete();
        return redirect(RouteServiceProvider::HOME);
    }
}
