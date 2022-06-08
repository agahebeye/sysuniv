<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DepartmentController
{
    public function index()
    {
        return auth()->user()->load('faculties.departments');

        return Inertia::render('departments/index', [
            'departments' => Department::get()
        ]);
    }

    public function create()
    {
        return Inertia::render('departments/create');
    }
    public function store()
    {
        $data = request()->validate(['name' => ['required', 'departments:unique']]);
        Department::query()->create($data);
        return to_route('departments.index');
    }
}
