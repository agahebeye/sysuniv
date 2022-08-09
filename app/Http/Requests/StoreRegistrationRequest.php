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
        if (\is_null($registration) && $this->input('level') >  LevelType::BAC_1->value) {
            throw ValidationException::withMessages([
                'student_id' => "Vous devez commencer par BAC I"
            ]);
        }

        if ($registration) {
            // a student hasn't finished a year
            if (is_null($registration->result) && !$registration->has_abandoned) {
                $this->warnStudentHasnotFinished($registration);
            }

            // wants to redo a year
            if ($registration?->result->mention == ResultStatus::PASSED && $registration->level->value == $this->input('level')) {
                throw ValidationException::withMessages([
                    'student_id' => "Vous ne pouvez pas étudier la même année deux fois."
                ]);
            }
            // a student has finished a year but wants to skip
            if ($this->wantsSkip($registration)) {
                throw ValidationException::withMessages([
                    'student_id' => "Vous ne pouvez pas s'inscrire dans l'année suivante sans avoir terminé la précedente."
                ]);
            }

            // a student wants to return to the previous year
            if ($this->wantsPreviousYear($registration)) {
                throw ValidationException::withMessages([
                    'student_id' => "Vous ne pouvez pas reprendre l'année précedente."
                ]);
            }
        }

        // must finish the year abandoned
        if ($registration->has_abandoned && $registration->level->value != $this->input('level')) {
            throw ValidationException::withMessages([
                'student_id' => "Vous devez reprendre l'année abondonnée d'abord."
            ]);
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
            'department_id' => ['nullable', 'numeric'],
            'faculty_id' => ['sometimes', 'numeric'],
            'institute_id' => ['sometimes', 'numeric'],
        ];
    }

    protected function wantsSkip($registration): bool
    {
        return ($registration?->result->mention == ResultStatus::FAILED && $registration->level->value < $this->input('level'))
            || ($registration?->result->mention == ResultStatus::PASSED &&
                $registration->level == LevelType::BAC_1
                && $this->input('level') == LevelType::BAC_3->value);
    }

    protected function warnStudentHasnotFinished($registration): void
    {
        throw ValidationException::withMessages([
            'student_id' => "Vous devez d'abord terminer "
                . ($registration->created_at->year == date('Y')
                    ? "cette année" : "l'année " . $registration->created_at->year
                )
                . ($registration->university->id != auth()->id() ? "à l'université {$registration->university->name}" : "") . " pour se réinscrire."
        ]);
    }

    protected function wantsPreviousYear($registration): bool
    {
        return ($registration?->result->mention == ResultStatus::FAILED || $registration?->result->mention == ResultStatus::PASSED)
            && $registration->level->value > $this->input('level');
    }
}
