<?php

namespace App\Actions;

use App\Models\User;
use App\Enums\UserType;
use App\Http\Requests\User\StoreUniversityRequest;
use App\Models\Faculty;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateUniversityAction
{
    public function handle(array $data): \App\Models\User
    {
        $university = DB::transaction(function () use ($data) {
            $university = User::query()->create(
                [
                    ...Arr::except($data, ['faculties', 'institutes']), 'role' => UserType::UNIVERSITY
                ]
            );
            
            $university->faculties()->attach($data['faculties']);
            $university->institutes()->attach($data['institutes']);
            $university->departments()->attach($data['departments']);

            return $university;
        });

        return $university;
    }
}
