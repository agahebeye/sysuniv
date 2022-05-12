<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UniversityController extends Controller
{
    public function index(): \Inertia\Response {
        return Inertia::render('universities/index', [
            'universities' => University::with(['photo'])->get()
        ]);
    }

    public function edit(int $univId): \Inertia\Response {
        $university = University::query()->find($univId);

        return Inertia::render('universities/index', [
            'university' => $university
        ]);
    }
}
