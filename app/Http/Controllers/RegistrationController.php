<?php

namespace App\Http\Controllers;

use App\Enums\LevelType;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Registration;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

class RegistrationController
{
    public function create(): \Inertia\Response
    {
        return Inertia::render('registrations/create', [
            'faculties' => Faculty::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
            'institutes' => Institute::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
        ]);
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $data = request()->validate([
            'level' => ['required', new Enum(LevelType::class)],
            'university_id' => ['required', 'numeric'],
            'student_id' => ['required', 'numeric'],
            'faculty_id' => ['sometimes', 'numeric'],
            'institute_id' => ['sometimes', 'numeric'],
        ]);

        Registration::query()->create($data);

        return redirect(RouteServiceProvider::HOME);
    }
}
