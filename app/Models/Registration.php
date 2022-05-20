<?php

namespace App\Models;

use App\Enums\LevelType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    const UPDATE_AT = null;

    protected $fillable = [
        'school_year',
        'level',
        'university_id',
        'student_id',
        'faculty_id',
        'institute_id'
    ];

    protected $casts = [
        'level' => LevelType::class
    ];
}
