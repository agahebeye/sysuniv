<?php

namespace App\Models;

use App\Enums\ResultStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'mention',
        'registration_id',
    ];

    protected $casts = [
        'mention' => ResultStatus::class
    ];

    const CREATED_AT = null;

    public function report()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
