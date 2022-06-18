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
            'notes' => ['required', 'numeric'],
            'credits' => ['required', 'numeric'],
        ]);
        // retrieve student's last registration
        $registration = $student->latestRegistration;
        // update correspondent result
        $registration->result()->update($data);

        if ($data['notes'] < 54 || $data['credits'] > 4) {
            $registration->update(['result_status' => ResultStatus::FAILED]);
        }

        if ($data['notes'] > 54 && $data['credits'] < 5) {
            $registration->update(['result_status' => ResultStatus::PASSED]);
        }
        // redirect to students list page
        return to_route('students.index');
    }
}
