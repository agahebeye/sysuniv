<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Student;
use App\Http\Resources\StudentResource;
use App\Providers\RouteServiceProvider;

class StudentPhotoController
{
    public function create(Student $student)
    {
        return Inertia::render('students/photos/create', [
            'student' => StudentResource::make($student),
        ]);
    }

    public function store(Student $student)
    {
        request()->validate(['photo' => ['image', 'dimensions:min_with=200,min_height=200', 'max:2000']]);
        $photo = request()->file('photo')->storePublicly('/avatars', 'public');
        $student->photo()->create(['src' => $photo]);
        return redirect(RouteServiceProvider::HOME);
    }
}
