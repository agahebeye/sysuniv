<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Http\Requests\RegisteredEmployeeRequest;

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

      public function store(RegisteredEmployeeRequest $request)
    {
        $user = User::query()->create($request->validated());
        
        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

}
