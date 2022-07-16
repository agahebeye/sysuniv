<?php

namespace App\Models;

use App\Enums\LevelType;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasRegistrationRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
    use HasRegistrationRelations;

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
