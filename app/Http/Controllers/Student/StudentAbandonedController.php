<?php

namespace App\Http\Controllers\Student;

use App\Enums\ResultStatus;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentAbandonedController
{
    public function __invoke(Student $student)
    {
        $hasAbandoned = $student->latestRegistration->has_abandoned;
        $student->latestRegistration->update(['has_abandoned' => !$hasAbandoned]);
        $pas =  $hasAbandoned ? 'pas' : '';

        return back()->with(
            'success',
            <<<SUCCESS
                L'étudiant $student->lastname $student->firstname a été marqué(e)
                $pas abandonné(e).
             SUCCESS
        );
    }
}
