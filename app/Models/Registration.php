<?php

namespace App\Models;

use App\Enums\LevelType;
use App\Enums\ResultStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'level',
        'university_id',
        'student_id',
        'faculty_id',
        'institute_id',
        'result_status',
    ];

    protected $casts = [
        'level' => LevelType::class,
        'result_status' => ResultStatus::class
    ];

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
