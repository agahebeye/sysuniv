<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Department;
use App\Actions\CreateUniversityAction;
use App\Actions\UpdateUniversityAction;
use App\Http\Resources\UniversityResource;
use App\Notifications\UniversityRegistered;
use App\Http\Requests\User\StoreUniversityRequest;
use App\Http\Requests\User\UpdateUniversityRequest;

class UniversityController
{
    public function index(): \Inertia\Response
    {
        $universities = User::university()->with(['photo'])->get();

        return Inertia::render('universities/index', [
            'universities' => UniversityResource::collection($universities)
        ]);
    }

    public function show(User $university)
    {
        return Inertia::render('universities/show', [
            'university' => UniversityResource::make($university->load(['photo'])
                ->loadCount(['faculties', 'institutes', 'students']))
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('universities/create', [
            'faculties' => Faculty::query()->get(['id', 'name']),
            'institutes' => Institute::query()->get(['id', 'name']),
            'departments' => Department::query()->get(['id', 'name']),
        ]);
    }

    public function store(StoreUniversityRequest $request, CreateUniversityAction $createUniversityAction)
    {
        $university =  $createUniversityAction->handle($request->validated());

        $university->notify((new UniversityRegistered($request->password))->afterCommit());

        $request->session()->flash('success', "University <em>$university->name</em> succefully registered.");

        return to_route('universities.photos.edit', $university->getRouteKey());
    }

    public function edit(User $university)
    {
        return Inertia::render('universities/edit', [
            'university' => UniversityResource::make($university->load('faculties', 'institutes', 'departments')),
            'faculties' => Faculty::query()->get(),
            'institutes' => Institute::query()->get(),
            'departments' => Department::query()->get()
        ]);
    }

    public function update(User $university, UpdateUniversityRequest $request, UpdateUniversityAction $updateUniversityAction)
    {
        $updateUniversityAction->handle($university, $request);
        return to_route('universities.index')->with('success', "University $university->name succefully updated.");;
    }
}
