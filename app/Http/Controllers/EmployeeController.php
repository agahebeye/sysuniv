<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class EmployeeController
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('universities/index', [
            'universities' => User::employee()->with(['photo'])->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('employees/create');
    }

    public function edit(User $employee): \Inertia\Response
    {
        return Inertia::render('employees/edit', [
            'employee' => $employee
        ]);
    }
}
