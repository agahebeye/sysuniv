<?php

namespace App\Http\Controllers;

use App\Enums\LevelType;
use App\Enums\ResultStatus;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Registration;
use App\Models\Result;
use App\Models\Student;
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

    public function store(Student $student) //: \Illuminate\Http\RedirectResponse
    {
        $data = request()->validate([
            'level' => ['required', new Enum(LevelType::class)],
            'university_id' => ['required', 'numeric'],
            'faculty_id' => ['sometimes', 'numeric'],
            'institute_id' => ['sometimes', 'numeric'],
        ]);

        $registration = $student->latestRegistration;

        // a student has never registered before
        if (!$registration) {
            $freshRegistration = Registration::query()->create([...$data, 'student_id' => $student->id]);
            $freshRegistration->result()->create();
        }

        // a student hasn't finished a year
        if ($student->result_status == ResultStatus::PENDING) {
            throw ValidationException::withMessages([
                'student_id' => "you have to finish "
                    . $registration->created_at->year == date('Y') ? "this year" : "the year $registration->created_at->year"
                    . " to register anew"
            ]);
        }

        return $registration->level->value > $data['level'];

        if ($student->result_status == ResultStatus::FAILED && $registration->level->value > $data['level'])

            return redirect(RouteServiceProvider::HOME);
    }
}
