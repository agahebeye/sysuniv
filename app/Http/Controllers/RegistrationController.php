<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Student;
use App\Enums\LevelType;
use App\Models\Institute;
use App\Enums\ResultStatus;
use App\Models\Registration;
use Illuminate\Validation\Rules\Enum;
use App\Providers\RouteServiceProvider;
use App\Actions\CreateRegistrationAction;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\StoreRegistrationRequest;

class RegistrationController
{
    public function create(): \Inertia\Response
    {
        return Inertia::render('registrations/create', [
            'faculties' => Faculty::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
            'institutes' => Institute::query()->whereRelation('universities', 'users.id', auth()->id())->get(['id', 'name']),
        ]);
    }

    public function store(Student $student, StoreRegistrationRequest $storeRegistrationRequest) //: \Illuminate\Http\RedirectResponse
    {
        $storeRegistrationRequest->verify($student->latestRegistration);
        return redirect(RouteServiceProvider::HOME)->with('success', 'Student registered with success');
    }
}
