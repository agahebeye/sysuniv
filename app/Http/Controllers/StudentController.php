<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Enums\UserType;
use App\Models\Student;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;

class StudentController
{
    public function index(): \Inertia\Response
    {
        $students = Student::query()
            ->when(
                auth()->user()->role == UserType::UNIVERSITY,
                fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
            )->paginate(15);

        return Inertia::render('students/index', [
            'students' => StudentResource::collection($students)
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('students/create');
    }

    public function store(StoreStudentRequest $request): \Illuminate\Http\RedirectResponse | array
    {
        $data = $request->validated();

        $student = DB::transaction(fn () => Student::query()->create($data));

        $request->session()->flash(
            'success',
            "Le numéro matricule de {$student->firstname} uniquement généré est:  <strong>$student->registration_number</strong>"
        );

        return to_route('students.photos.create', $student->getRouteKey());
    }

    public function show(Student $student): \Inertia\Response
    {
        $studentResource = StudentResource::make($student->load([
            'photo',
            'registrations' => [
                'university',
                'faculty',
                'institute',
                'department',
                'result' => ['report']
            ]
        ]));

        return Inertia::render('students/show', [
            'student' => $studentResource,
            'latestRegistration' =>  $student->latestRegistration?->load(['result', 'university'])->toArray(),
        ]);
    }

    public function edit(Student $student): \Inertia\Response
    {
        return Inertia::render('students/edit', [
            'student' => $student
        ]);
    }

    public function update(StoreStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        $student->update($data);

        return redirect(RouteServiceProvider::HOME);
    }
}
