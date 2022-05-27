<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Institute;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
            'faculties' => Faculty::query()->get(['id', 'name']),
            'institutes' => Institute::query()->get(['id', 'name']),
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

        //DB::transaction(function () use ($data) {

            $university = User::query()->create(
                [
                    ...Arr::except($data, ['faculties', 'institutes']),
                    'role' => UserType::UNIVERSITY,
                ]
            );

            $university->faculties()->attach($data['faculties']);
            $university->institutes()->attach($data['institutes']);

      //  });

        return to_route('universities.index');
    }
}
