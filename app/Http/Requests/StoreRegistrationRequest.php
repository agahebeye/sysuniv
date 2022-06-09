<?php

namespace App\Http\Requests;

use App\Enums\LevelType;
use App\Enums\ResultStatus;
use App\Models\Registration;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Verify student's possible registrations
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function verify(Registration $registration = null)
    {
        if ($registration) {
            // a student hasn't finished a year
            if ($registration->result_status == ResultStatus::PENDING) {
                throw ValidationException::withMessages([
                    'student_id' => "you have to finish "
                        . ($registration->created_at->year == date('Y') ? "this year" : "the year " . $registration->created_at->year)
                        . " to register anew"
                ]);
            }

            if ($registration->result_status == ResultStatus::PASSED && $registration->level->value == $this->input('level')) {
                throw ValidationException::withMessages([
                    'student_id' => "you cannot register twice in the year you passed"
                ]);
            }
            // a student has finished a year but wants to skip
            if (
                ($registration->result_status == ResultStatus::FAILED && $registration->level->value < $this->input('level'))
                || ($registration->result_status == ResultStatus::PASSED &&
                    $registration->level == LevelType::BAC_1
                    && $this->input('level') == LevelType::BAC_3->value)
            ) {
                throw ValidationException::withMessages([
                    'student_id' => "you cannot register in the next year while you have not finished the previous one"
                ]);
            }

            // a student wants to return to the previous year
            if (
                ($registration->result_status == ResultStatus::FAILED || $registration->result_status == ResultStatus::PASSED)
                && $registration->level->value > $this->input('level')
            ) {
                throw ValidationException::withMessages([
                    'student_id' => "you cannot register in the year you've already studied"
                ]);
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'level' => ['required', new Enum(LevelType::class)],
            'university_id' => ['required', 'numeric'],
            'department_id' => ['required', 'numeric'],
            'faculty_id' => ['sometimes', 'numeric'],
            'institute_id' => ['sometimes', 'numeric'],
        ];
    }
}
