<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Faculty;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacultyController
{
    public function index()
    {
        $faculties = Faculty::query()
            ->when(
                auth()->user()->role == UserType::UNIVERSITY,
                fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
            )->get();
        
        return Inertia::render('faculties/index', [
            'faculties' => $faculties
        ]);
    }

    public function create()
    {
        return Inertia::render('faculties/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'unique:faculties']
        ]);

        Faculty::create($data);

        return redirect(RouteServiceProvider::HOME);
    }

    public function show(Faculty $faculty)
    {
        //
    }
}
