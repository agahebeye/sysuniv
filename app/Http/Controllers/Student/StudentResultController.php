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

    public function update(Student $student) {
        // retrieve student's last registration
        // update correspondent result
        // redirect to students list page
        return to_route('students.index');
    }
}
