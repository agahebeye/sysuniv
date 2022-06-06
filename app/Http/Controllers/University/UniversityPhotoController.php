<?php

namespace App\Http\Controllers\University;

use App\Models\User;
use App\Providers\RouteServiceProvider;

class UniversityPhotoController
{
    public function update(User $user)
    {
        request()->validate(['photo' => ['image', 'dimensions:min_with=200,min_height=200', 'max:2000']]);
        $photo = request()->file('photo')->storePublicly('/avatars', 'public');
        $user->photo()->updateOrCreate([], ['src' => $photo]);
        return redirect(RouteServiceProvider::HOME);
    }
}
