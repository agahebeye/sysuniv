<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;

class VerifyStudentController
{
    public function __invoke($number)
    {
        return Student::query()->where('registration_number', $number)->firstOrFail(['id', 'registration_number']);
    }
}
