<?php

namespace App\Http\Controllers\Institute;

use App\Models\Institute;

class InstituteDepartmentController
{
  public function index(Institute $institute)
    {
        $departments = Departement::query()
            ->whereHas(
                'institutes',
                fn (Builder $builder) => $builder->whereRelation('universities', 'users.id', auth()->id())
            );

        return Inertia::render('institutes/departements/index', [
            'departments' => $departments
        ]);
    }

    public function create(Institute $institute)
    {
        return Inertia::render('institutes/departements/create');
    }

    public function store(Institute $institute)
    {
        $data = request()->validate(['departements' => ['array']]);
        $institute->departments()->create($data);
        return to_route('institutes.departements');
    }
}
