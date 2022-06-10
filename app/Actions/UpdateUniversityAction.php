<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class UpdateUniversityAction
{
    public function handle($university, $request)
    {
        $university = DB::transaction(function () use ($university, $request) {
                $university->update($data = $request->getSafeData());

                $university->faculties()->sync($data['faculties']);
                $university->faculties()->sync($data['institutes']);
                $university->faculties()->sync($data['departments']);

                return $university;
        });
        
        dd($university->load(['faculties', 'institutes', 'departments'])->toArray());

        if (Arr::has($request->getSafeData(), ['email', 'password'])) {
            $university->notify((new UniversityUpdated($request->password))->afterCommit());
        }
    }
}
