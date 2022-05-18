<?php

namespace App\Http\Controllers\University;

use App\Models\Institute;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UniversityFacultyController extends Controller
{
    public function __invoke(Institute $university)
    {
        $institutes = Institute::query()->whereRelation('universities', 'id', $university->id)->get();
        return Inertia::render('universities/institutes', [
            'institutes' => $institutes,
            'isVerified' => $university->hasVerifiedEmail(),
        ]);
    }
}
