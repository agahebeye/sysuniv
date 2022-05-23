<?php
namespace App\Http\Controllers;

use App\Enums\LevelType;
use App\Models\Registration;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

class RegistrationController
{
    public function create(): \Inertia\Response {
        return Inertia::render('registrations/create');
    }

    public function store() {
        $data = request()->validate([
            'level' => ['required', new Enum(LevelType::class)],
            'student_id' => ['required', Rule::exists('students', 'id')],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'faculty_id' => ['filled', Rule::exists('faculties', 'id')],
            'institute_id' => ['filled', Rule::exists('institutes', 'id')],
        ]);

        Registration::query()->create($data);

        return redirect(RouteServiceProvider::HOME);
    }
}
