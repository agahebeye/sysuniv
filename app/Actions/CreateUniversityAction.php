<?php

namespace App\Actions;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Support\Arr;

class createUniversityAction
{
    public function handle(array $data)
    {
        $university = User::query()->create(
            [
                ...Arr::except($data, ['faculties', 'institutes']),
                'role' => UserType::UNIVERSITY,
            ]
        );

        $university->faculties()->attach($data['faculties']);
        $university->institutes()->attach($data['institutes']);

        return $data;
    }
}
