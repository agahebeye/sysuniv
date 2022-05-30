<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;

use function PHPSTORM_META\map;

class VerifyStudentRegistrationController
{
    public function __invoke($id)
    {
        return  Student::query()->where('registration_number', $id)->firstOrFail(['id', 'firstname', 'lastname']);
    }
}
