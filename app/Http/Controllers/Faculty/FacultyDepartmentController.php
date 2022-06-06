<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Departement;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class FacultyDepartmentController
{
    public function index(Faculty $faculty)
    {
        $departments = Departement::query()
            ->whereBelongsTo($faculty)
            ->whereHas(
                'faculties',
                fn (Builder $builder) => $builder
                    ->where('id', $faculty->id)
                    ->whereRelation('universities', 'users.id', auth()->id())
            )->get();

        return Inertia::render('faculties/departements/index', [
            'departments' => $departments
        ]);
    }

    public function create(Faculty $faculty)
    {
        return Inertia::render('faculties/departements/create');
    }

    public function store(Faculty $faculty)
    {
        $data = request()->validate(['departements' => ['array']]);
        $faculty->departments()->create($data);
        return to_route('faculties.departements');
    }
}
