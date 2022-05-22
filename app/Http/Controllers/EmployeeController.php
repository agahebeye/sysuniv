<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class EmployeeController
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('employees/index', [
            'employees' => User::employee()->with(['photo'])->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('employees/create');
    }
}
