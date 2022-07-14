<?php

namespace App\Http\Controllers\Student;

use App\Enums\ResultStatus;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Inertia\Inertia;

class StudentResultController
{
    public function create(Student $student)
    {
        return Inertia::render('students/results/create', [
            'student' => StudentResource::make($student)
        ]);
    }

    public function update(Student $student)
    {
        $data = request()->validate([
            'photo' => ['image', 'dimensions:min_with=200,min_height=200', 'max:2000'],
            'notes' => ['required', 'numeric'],
            'mention' => ['required', 'string'],
        ]);
        // retrieve student's last registration
        $registration = $student->latestRegistration;
        // update correspondent result
        $registration->result()->update([
            'notes' => request()->input('notes'),
            'mention' => request()->input('mention'),
        ]);

        
        // redirect to students list page
        return to_route('students.show', $student->getRouteKey());
    }
}
