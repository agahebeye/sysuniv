<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;

class VerifyStudentRegistrationController
{
    public function __invoke($id)
    {
        return Student::query()->where('registration_number', $id)->first(['id', 'firstname', 'lastname', 'registration_number']);
    }
}
