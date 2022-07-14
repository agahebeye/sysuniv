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
            'document' => ['image', 'dimensions:min_with=200,min_height=200', 'max:2000'],
            'notes' => ['required', 'numeric'],
            'mention' => ['required', 'string'],
        ]);
        // retrieve student's last registration
        $registration = $student->latestRegistration;
        // update correspondent result
        $result = $registration->result()->create([
            'notes' => request()->input('notes'),
            'mention' => request()->input('mention'),
        ]);

        $document = request()->file('doucment')->storePublicly('/reports', 'public');
        $result->report()->create(['src' => $document]);
        // redirect to students list page
        return to_route('students.show', $student->getRouteKey());
    }
}
