<?php

namespace App\Actions;

use App\Models\User;
use App\Enums\UserType;
use App\Http\Requests\User\StoreUniversityRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateUniversityAction
{
    public function handle(array $data): \App\Models\User
    {
        $university = DB::transaction(function () use ($data) {
            $university = User::query()->updateOrCreate(
                ['id' => $data['id']],
                [...Arr::except($data, ['faculties', 'institutes']), ['role' => UserType::UNIVERSITY]]
            );

            $university->faculties()->sync($data['faculties']);
            $university->institutes()->sync($data['institutes']);

            return $university;
        });

        return $university;
    }
}
