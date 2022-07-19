<?php

namespace App\Models\Concerns\Registrations;

use App\Models\User;
use App\Models\Result;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Institute;
use App\Models\Department;

trait HasRegistrationRelationships
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function university()
    {
        return $this->belongsTo(User::class, 'university_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
