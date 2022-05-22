<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UniversityController
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('universities/index', [
            'universities' => User::university()->with(['photo'])->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('universities/create');
    }
}
