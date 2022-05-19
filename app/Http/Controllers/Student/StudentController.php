<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Student;
use App\Enums\GenderType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Enum;

class StudentController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('students/index', [
            'students' => Student::query()->with(['photo'])->latest()->get()
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('students/create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'gender' => ['required', new Enum(GenderType::class)],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string']
        ]);

        Student::create($data);

        return to_route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  student$
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return Inertia::render('students/show', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  student$
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return Inertia::render('students/edit', [
            'student' => $student
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'nom' => ['required', 'string']
        ]);

        $student->update($data);

        return to_route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return to_route('students.index');
    }
}
