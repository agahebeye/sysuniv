<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institute extends Model
{
    use HasFactory, SoftDeletes;

    const UPDATED_AT = null;
    protected $fillable = ['nom'];

    public function universities() {
        return $this->belongsToMany(University::class, 'universities_institutes');
    }
}
