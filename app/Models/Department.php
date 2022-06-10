<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'registrations');
    }

    public function institutes()
    {
        return $this->belongsToMany(Institute::class, 'registrations');
    }

    public function universities()
    {
        return $this->belongsToMany(User::class, 'universities_departments', relatedPivotKey: 'university_id');
    }
}
