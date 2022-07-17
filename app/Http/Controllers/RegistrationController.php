<?php

namespace App\Http\Controllers;

use App\Enums\ResultStatus;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Institute;
use App\Models\Department;
use App\Models\Registration;
use App\Http\Requests\StoreRegistrationRequest;

class RegistrationController
{
    public function create(): \Inertia\Response
    {
        dump(request()->user()->isUniversity);
        return Inertia::render('registrations/create', [
            'faculties' => Faculty::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
            'institutes' => Institute::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
            'departments' => Department::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
        ]);
    }

    public function store(Student $student, StoreRegistrationRequest $storeRegistrationRequest): \Illuminate\Http\RedirectResponse
    {
        $storeRegistrationRequest->verify($student->latestRegistration);

        $freshRegistration = Registration::query()->create([
            ...$storeRegistrationRequest->safe()->all(),
            'student_id' => $student->id
        ]);

        return to_route('students.index')->with('success', "L'étudiant a été enregistré avec succès.");
    }
}
