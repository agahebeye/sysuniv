<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;

class StudentRegistrationNumberController
{
    public function __invoke($number)
    {
        return Student::query()->where('registration_number')->firstOrFail(['id', 'registration_number']);
    }
}
