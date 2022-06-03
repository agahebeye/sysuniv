<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Inertia\Inertia;

class StudentResultController
{
    public function create(Student $student) {
        return Inertia::render('students/results/create', [
            'student' => $student
        ]);
    }
}
