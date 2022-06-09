<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Institute;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Department;

class RegistrationController
{
    public function create(): \Inertia\Response
    {
        return Inertia::render('registrations/create', [
            'faculties' => Faculty::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
            'institutes' => Institute::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
            'Departments' => Department::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
        ]);
    }

    public function store(Student $student, StoreRegistrationRequest $storeRegistrationRequest): \Illuminate\Http\RedirectResponse
    {
        $storeRegistrationRequest->verify($student->latestRegistration);
        return redirect(RouteServiceProvider::HOME)->with('success', 'Student registered with success');
    }
}
