<?php

namespace App\Http\Controllers;

use App\Actions\CreateUniversityAction;
use App\Http\Requests\User\StoreUniversityRequest;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Institute;
use App\Notifications\UniversityRegistered;

class UniversityController
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('universities/index', [
            'universities' => User::university()->with(['photo'])->get()
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
}