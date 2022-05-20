<?php

namespace App\Http\Controllers\University;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Inertia\Inertia;

class UniversityStudentController extends Controller
{
    public function __invoke(University $university)
    {
        $students = Student::query()->whereRelation('universities', 'universities.id', $university->id)->get();
        
        return Inertia::render('universities/students', [
            'students' => $students,
            'isVerified' => $university->hasVerifiedEmail(),
        ]);
    }
}
