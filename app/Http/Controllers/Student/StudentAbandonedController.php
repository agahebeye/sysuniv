<?php

namespace App\Http\Controllers\Student;

use App\Enums\ResultStatus;
use App\Models\Student;

class StudentAbandonedController
{
    public function __invoke(Student $student)
    {
        dd($student->result);
        // $student->latestRegistration->update(['result_status' => ResultStatus::ABANDONED]);
        // return back()->with('success', "L'étudiant $student->lastname $student->firstname a été marqué(e) abandonné(e).");
    }
}
