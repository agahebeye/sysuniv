<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Student;
use App\Enums\GenderType;
use App\Enums\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
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

    public function store(Request $request)/*: \Illuminate\Http\RedirectResponse*/
    {
        $data = $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'gender' => [new Enum(GenderType::class)],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'address' => ['required', 'string'],

            'photo' => ['required', 'image']
        ]);

        DB::transaction(function () use ($data, $request) {
            $avatar = $request->file('photo')->storePublicly('/avatars', 'public');
            $student = Student::query()->create(Arr::except($data, ['photo']));
            $student->photo()->create(['src' => $avatar]);
        });

        return to_route('students.index');
    }

    public function show(Student $student): \Inertia\Response
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

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'firstname' => ['sometimes', 'string'],
            'lastname' => ['sometimes', 'string'],
            'gender' => ['sometimes', new Enum(GenderType::class)],
            'birth_date' => ['sometimes', 'date_format:Y-m-d'],
            'address' => ['sometimes', 'string'],

            'photo' => ['sometimes', 'image']
        ]);


        $student->update(Arr::except($data, ['photo']));

        if (array_key_exists('photo', $data)) {
            $avatar = $request->file('photo')->storePublicly('/avatars', 'public');
            $student->photo()->updateOrCreate([], ['src' => $avatar]);
        }

        return to_route('students.index');
    }

    public function destroy(Student $student)
    {
        abort_unless(request()->user()->role_type == UserType::ADMIN, 403);
        $student->delete();
        return to_route('students.index');
    }
}
