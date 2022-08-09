<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StudentResource;
use App\Models\Student;

class VerifyStudentController
{
    public function __invoke($number)
    {
        $student = Student::query()->whereRegistrationNumber($number)->first();

        if (!$student) {
            return response()->json([
                'data' => null,
                'message' => "L'étudiant avec ce numéro matricule n'existe pas."
            ]);
        }

        return ['data' =>  StudentResource::make($student), 'message' => "L'étudiant avec ce numéro matricule existe."];
    }
}
