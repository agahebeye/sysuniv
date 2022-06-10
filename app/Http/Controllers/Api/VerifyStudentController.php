<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;

class VerifyStudentController
{
    public function __invoke($id)
    {
        return  Student::query()->where('registration_number', $id)->firstOrFail(['id'])->getRouteKey();
    }
}
