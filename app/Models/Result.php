<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'credits',
        'registration_id',
    ];

    const CREATED_AT = null;

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
