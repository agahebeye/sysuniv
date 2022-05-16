<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public function universities() {
        return $this->belongsToMany(University::class, 'universities_institutes');
    }
}
