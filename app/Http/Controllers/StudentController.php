<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Enums\UserType;
use App\Models\Student;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\RegisteredStudentRequest;

class StudentController
{
    public function index(): \Inertia\Response
    {
        $students = Student::query()
            ->when(
                auth()->user()->role == UserType::UNIVERSITY,
                fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
            )->get();

        return Inertia::render('students/index', [
            'students' => $students
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('students/create');
    }

    public function store(RegisteredStudentRequest $request): \Illuminate\Http\RedirectResponse | array
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $avatar = request()->file('photo')->storePublicly('/avatars', 'public');
            $student = Student::query()->create(Arr::except($data, ['photo']));
            $student->photo()->create(['src' => $avatar]);
        });

        return redirect(RouteServiceProvider::HOME);
    }

    public function show(Student $student)/*: \Inertia\Response*/
    {
        return Inertia::render('students/show', [
            'student' => $student
        ]);
    }

    public function edit(Student $student): \Inertia\Response
    {
        return Inertia::render('students/edit', [
            'student' => $student
        ]);
    }

    public function update(RegisteredStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        $student->update(Arr::except($data, ['photo']));

        if (array_key_exists('photo', $data)) {
            $avatar = $request->file('photo')->storePublicly('/avatars', 'public');
            $student->photo()->updateOrCreate([], ['src' => $avatar]);
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function verifyRegistrationNumber($number)
    {
        return Student::query()->where('registration_number', $number)->firstOrFail(['id', 'registration_number']);
    }
}
