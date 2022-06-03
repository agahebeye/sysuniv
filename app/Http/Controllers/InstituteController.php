<?php

namespace App\Http\Controllers;


use Inertia\Inertia;
use App\Enums\UserType;
use App\Models\Institute;
use Illuminate\Database\Eloquent\Builder;

class InstituteController
{
    public function index()
    {
        $institutes = Institute::query()
            ->when(
                auth()->user()->role == UserType::UNIVERSITY,
                fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
            )->get();

        return Inertia::render('institutes/index', [
            'institutes' => $institutes
        ]);
    }

    public function create()
    {
        return Inertia::render('institutes/create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'unique:institutes']
        ]);

        Institute::query()->create($data);

        return to_route('institutes.index');
    }
}
