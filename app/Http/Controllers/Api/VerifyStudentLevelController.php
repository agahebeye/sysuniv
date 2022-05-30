<?php

namespace App\Http\Controllers\Api;

use App\Models\Registration;

class VerifyStudentLevelController
{
    public function __invoke($id, $level)
    {
        return Registration::query()
            ->where('id', $id)
            ->where('level', $level)
            ->whereYear('created_at', date('Y'))
            ->firstOrFail();
    }
}
