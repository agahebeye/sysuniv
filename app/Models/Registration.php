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

    /**
     * Relationships
     */
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
