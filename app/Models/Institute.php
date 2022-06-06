<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function universities()
    {
        return $this->belongsToMany(User::class, 'universities_institutes', relatedPivotKey: 'university_id');
    }

    public function departments()
    {
        return $this->morphMany(Departement::class, 'fieldable');
    }
}
