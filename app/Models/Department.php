<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function universities()
    {
        return $this->belongsToMany(User::class, 'registrations', relatedPivotKey: 'university_id');
    }
}
