<?php

namespace App\Models;

use App\Enums\LevelType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\Registrations\HasRegistrationRelationships;

class Registration extends Model
{
    use HasFactory;
    use HasRegistrationRelationships;

    const UPDATED_AT = null;

    protected $fillable = [
        'level',
        'university_id',
        'student_id',
        'faculty_id',
        'institute_id',
        'department_id',
        'has_abandoned',
    ];

    protected $casts = [
        'level' => LevelType::class,
        'has_abandoned' => 'boolean'
    ];
}
