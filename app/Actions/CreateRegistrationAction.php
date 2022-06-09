<?php

namespace App\Actions;

use App\Models\Student;
use App\Enums\LevelType;
use App\Enums\ResultStatus;
use App\Models\Registration;
use Illuminate\Validation\ValidationException;

class CreateRegistrationAction
{
    public function handle(Student $student, $data)
    {
        $registration = $student->latestRegistration;

        if ($registration) {
            // a student hasn't finished a year
            if ($registration->result_status == ResultStatus::PENDING) {
                throw ValidationException::withMessages([
                    'student_id' => "you have to finish "
                        . ($registration->created_at->year == date('Y') ? "this year" : "the year " . $registration->created_at->year)
                        . " to register anew"
                ]);
            }

            if ($registration->result_status == ResultStatus::PASSED && $registration->level->value == $data['level']) {
                throw ValidationException::withMessages([
                    'student_id' => "you cannot register twice in the year you passed"
                ]);
            }
            // a student has finished a year but wants to skip
            if (
                ($registration->result_status == ResultStatus::FAILED && $registration->level->value < $data['level'])
                || ($registration->result_status == ResultStatus::PASSED &&
                    $registration->level == LevelType::BAC_1
                    && $data['level'] == LevelType::BAC_3->value)
            ) {
                throw ValidationException::withMessages([
                    'student_id' => "you cannot register in the next year while you have not finished the previous one"
                ]);
            }

            // a student wants to return to the previous year
            if (
                ($registration->result_status == ResultStatus::FAILED || $registration->result_status == ResultStatus::PASSED)
                && $registration->level->value > $data['level']
            ) {
                throw ValidationException::withMessages([
                    'student_id' => "you cannot register in the year you've already studied"
                ]);
            }
        }

        $freshRegistration = Registration::query()->create([...$data, 'student_id' => $student->id]);
        $freshRegistration->result()->create();
    }
}
