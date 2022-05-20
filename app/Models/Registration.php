<?php

namespace App\Models;

use App\Enums\LevelType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

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

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function university() {
        return $this->belongsTo(University::class);
    }

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function institute() {
        return $this->belongsTo(Institute::class);
    }
}
