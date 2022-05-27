<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Institute;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rules;

class UniversityController
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('universities/index', [
            'universities' => User::university()->with(['photo'])->get()
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('universities/create', [
            'faculties' => Faculty::query()->get(),
            'institutes' => Institute::query()->get(),
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'website' => ['required', 'url'],
            'address' => ['required', 'string'],

            'faculties' => ['array'],
            'institutes' => ['array'],
        ]);

        return $data;
    }
}
