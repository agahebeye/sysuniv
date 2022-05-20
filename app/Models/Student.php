<?php

namespace App\Models;

use App\Enums\GenderType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'firstname',
        'lastname',
        'gender',
        'birth_date',
        'address'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'gender' => GenderType::class
    ];

    protected static function booted()
    {
        static::creating(fn ($student) => $student->registration_number = Str::random(10));
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function documents()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function universities()
    {
        return $this->belongsToMany(University::class, 'registrations');
    }

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'registrations')->wherePivotNotNull('faculty_id');
    }

    public function institutes()
    {
        return $this->belongsToMany(Institute::class, 'registrations')->wherePivotNotNull('institute_id');
    }
}
