<?php

namespace App\Http\Controllers;

use App\Enums\LevelType;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Registration;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
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

    public function store()
    {
        $data = request()->validate([
            'level' => ['required', new Enum(LevelType::class)],
            'user_id' => ['required', 'numeric'],
            'student_id' => ['required', 'numeric'],
            'faculty_id' => ['sometimes', 'numeric'],
            'institute_id' => ['sometimes', 'numeric'],
        ]);

        throw ValidationException::withMessages([
            'student_id' => 'Oops, cannot enroll twice in the same year'
        ]);

        //1. retrieve a registration
        $registration = Registration::query()
            ->latest()->where($data)->whereYear(date('Y'))->first();
        //2. check a student is still studying in this year
        if ($registration) {
            throw ValidationException::withMessages([
                'email' => 'Oops, cannot enroll twice in the same year'
            ]);
        }
        //2.1 check if 

        Registration::query()->create($data);

        return redirect(RouteServiceProvider::HOME);
    }
}
