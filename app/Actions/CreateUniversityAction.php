<?php

namespace App\Actions;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Support\Arr;

class CreateUniversityAction
{
    public function handle(array $data): \App\Models\User
    {
        $university = User::query()->create(
            [
                ...Arr::except($data, ['faculties', 'institutes']),
                'role' => UserType::UNIVERSITY,
            ]
        );

        $university->faculties()->attach($data['faculties']);
        $university->institutes()->attach($data['institutes']);

        return $university;
    }
}
