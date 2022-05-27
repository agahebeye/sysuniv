<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Faculty;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class FacultyController
{
    public function index(): \Inertia\Response
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

    public function create(): \Inertia\Response
    {
        return Inertia::render('faculties/create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'unique:faculties']
        ]);

        Faculty::query()->create($data);

        return to_route('faculties.index'); 
    }

    public function show(Faculty $faculty)
    {
        //
    }
}
