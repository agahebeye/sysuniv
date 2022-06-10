<?php

namespace App\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateUniversityAction
{
    public function handle($university, $request)
    {
        $university = DB::transaction(function () use ($university, $request) {
            $university->update($data = $request->getSafeData());

            $university->faculties()->sync($data['faculties']);
            $university->institutes()->sync($data['institutes']);
            $university->departments()->sync($data['departments']);

            return $university;
        });

        if (Arr::has($request->getSafeData(), ['email', 'password'])) {
            $university->notify((new UniversityUpdated($request->password))->afterCommit());
        }
    }
}
