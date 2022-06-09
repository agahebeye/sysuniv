<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Institute;
use Illuminate\Support\Arr;
use App\Actions\CreateUniversityAction;
use App\Notifications\UniversityRegistered;
use App\Http\Requests\User\StoreUniversityRequest;
use App\Http\Resources\UniversityResource;

class UniversityController
{
    public function index() //: \Inertia\Response
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
        ]);
    }

    public function store(StoreUniversityRequest $request, CreateUniversityAction $createUniversityAction)
    {
        $university =  $createUniversityAction->handle($request->validated());

        $university->notify((new UniversityRegistered($request->password))->afterCommit());

        return to_route('universities.index');
    }

    public function edit(User $university)
    {
    }

    public function update(User $university)
    {
    }
}
