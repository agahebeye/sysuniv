<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institute extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    public function universities()
    {
        return $this->belongsToMany(User::class, 'universities_institutes', relatedPivotKey: 'university_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'registrations');
    }
}
