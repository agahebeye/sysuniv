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
    public function index(): \Inertia\Response
    {
        $faculties = Faculty::query()
            ->when(
                auth()->user()->role == UserType::UNIVERSITY,
                fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
            )->latest('id')->get();

        return Inertia::render('faculties/index', [
            'faculties' => $faculties
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('faculties/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:faculties']
        ]);

        $facutly = Faculty::query()->create($data);

        $request->session()->flash(
            'success',
            "La faculté <em>{$facutly->name}</em> a été créée avec succès."
        );

        return to_route('faculties.index');
    }

    public function show(Faculty $faculty)
    {
        //
    }
}
