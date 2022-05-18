<?php

namespace App\Http\Controllers\University;

use App\Models\Institute;
use App\Http\Controllers\Controller;
use App\Models\University;
use Inertia\Inertia;

class UniversityInstituteController extends Controller
{
    public function __invoke(University $university)
    {
        $institutes = Institute::query()->whereRelation('universities', 'id', $university->id)->get();
        return Inertia::render('universities/institutes', [
            'institutes' => $institutes,
            'isVerified' => $university->hasVerifiedEmail(),
        ]);
    }
}
