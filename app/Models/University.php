<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public function photo() {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
