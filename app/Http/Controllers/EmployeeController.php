<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\User\StoreEmployeeRequest;

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

      public function store(StoreEmployeeRequest $request)
    {
        $user = User::query()->create($request->validated());
        
        return redirect(RouteServiceProvider::HOME);
    }

}
