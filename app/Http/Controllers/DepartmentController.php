<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Enums\UserType;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DepartmentController
{
    public function index()
    {
        $departments = Department::query()
            ->when(
                auth()->user()->role == UserType::UNIVERSITY,
                fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
            )->get();

        return Inertia::render('departments/index', [
            'departments' => $departments
        ]);
    }

    public function create()
    {
        return Inertia::render('departments/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'unique:departments']]);
        
        $department = Department::query()->create($data);

        $request->session()->flash(
            'success',
            "Le département <em>{$department->name}</em> a été créé avec succès."
        );

        return to_route('departments.index');
    }
}
