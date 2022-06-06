<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Inertia\Inertia;

class DepartementController
{
    public function index()
    {
        return Inertia::render('departments/index', [
            'departments' => Departement::get()
        ]);
    }

    public function create()
    {
        return Inertia::render('departments/create');
    }
    public function store()
    {
        $data = request()->validate(['name' => ['required', 'departments:unique']]);
        Departement::query()->create($data);
        return to_route('departments.index');
    }
}
