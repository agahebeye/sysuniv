<?php

namespace App\Http\Controllers\Employee;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class EmployeePhotoController
{
    public function edit(User $employee)
    {
        return Inertia::render('employees/photos/edit', [
            'employee' => $employee
        ]);
    }

    public function update(User $employee)
    {
        request()->validate(['photo' => ['image', 'dimensions:min_with=200,min_height=200', 'max:2000']]);
        $photo = request()->file('photo')->storePublicly('/avatars', 'public');
        $employee->photo()->update(['src' => $photo]);
        return redirect(RouteServiceProvider::HOME);
    }
}
