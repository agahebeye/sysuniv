<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;

    public function photo() {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
