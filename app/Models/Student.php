<?php

namespace App\Models;

use App\Enums\GenderType;
use App\Enums\ResultStatus;
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
        'result_status',
        'address'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'gender' => GenderType::class,
        'result_status' => ResultStatus::class
    ];

    protected static function booted()
    {
        static::creating(fn ($student) => $student->registration_number = Str::random(25));
    }

    public function getRouteKey()
    {
        return  \Hashids::connection(get_called_class())->encode($this->getKey());
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

    public function latestRegistration() {
        return $this->hasOne(Registration::class)->latestOfMany();
    }

    public function universities()
    {
        return $this->belongsToMany(User::class, 'registrations', relatedPivotKey: 'university_id');
    }

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'registrations')->wherePivotNotNull('faculty_id');
    }

    public function institutes()
    {
        return $this->belongsToMany(Institute::class, 'registrations')->wherePivotNotNull('institute_id');
    }

    public function results() {
        return $this->hasManyThrough(Result::class, Registration::class);
    }
}
