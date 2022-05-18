<?php

namespace App\Http\Controllers\University;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Inertia\Inertia;

class UniversityFacultyController extends Controller
{
    public function __invoke(University $university)
    {
        $faculties = Faculty::query()->whereRelation('universities', 'id', $university->id)->get();
        return Inertia::render('universities/faculties', [
            'faculties' => $faculties,
            'isVerified' => $university?->hasVerifiedEmail(),
        ]);
    }
}
