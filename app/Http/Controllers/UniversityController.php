<?php

namespace App\Http\Controllers;

use App\Actions\CreateUniversityAction;
use App\Enums\UserType;
use App\Http\Requests\User\StoreUniversityRequest;
use App\Mail\UniversityAdded;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Institute;
use App\Notifications\UniversityRegistered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;

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

        $university->notify((new UniversityRegistered())->afterCommit());

        return to_route('universities.index');
    }
}
