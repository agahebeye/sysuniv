<?php
namespace App\Http\Controllers;

use App\Enums\LevelType;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Registration;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

class RegistrationController
{
    public function create(): \Inertia\Response {
        return Inertia::render('registrations/create', [
            'faculties' => Faculty::query()->whereRelation('universities', 'users.id', auth()->id())->get(),
            'institutes' => Institute::query()->whereRelation('universities', 'users.id', auth()->id())->get(),
        ]);
    }

    public function store() {
        $data = request()->validate([
            'level' => ['required', new Enum(LevelType::class)],
            'student_id' => ['required', Rule::exists('students', 'id')],
            'faculty_id' => ['nullable', Rule::exists('faculties', 'id')],
            'institute_id' => ['nullable', Rule::exists('institutes', 'id')],
        ]);

        return $data;

        Registration::query()->create($data);

        return redirect(RouteServiceProvider::HOME);
    }
}
