<?php

namespace App\Http\Controllers\University;

use App\Http\Resources\UniversityResource;
use App\Models\User;
use Inertia\Inertia;

class UniversityPhotoController
{
    public function edit(User $university)
    {
        return Inertia::render('universities/photos/edit', [
            'university' => UniversityResource::make($university->load('photo'))
        ]);
    }

    public function update(User $university)
    {
        request()->validate(['photo' => ['image', 'dimensions:max:2000']]);
        $photo = request()->file('photo')->storePublicly('/avatars', 'public');
        $university->photo()->updateOrCreate([], ['src' => $photo]);
        return to_route('universities.index');
    }
}
