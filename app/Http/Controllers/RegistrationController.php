<?php

namespace App\Http\Controllers;

use App\Enums\LevelType;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Registration;
use App\Models\Result;
use App\Models\Student;
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

    public function store(Student $student) //: \Illuminate\Http\RedirectResponse
    {
        $data = request()->validate([
            'level' => ['required', new Enum(LevelType::class)],
            'university_id' => ['required', 'numeric'],
            'faculty_id' => ['sometimes', 'numeric'],
            'institute_id' => ['sometimes', 'numeric'],
        ]);

        $registration = $student->latestRegistration;

        if (is_null($registration)) {
            Registration::query()->create([...$data, 'student_id' => $student->id]);
            Result::query()->create();
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
