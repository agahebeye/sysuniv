<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'nif',
        'siteweb',
        'adresse',
        'suspendu'
    ];

    protected static function booted()
    {
        static::creating(
            function ($university) {
                $this->attributes['id'] = Str::random(3);
            }
        );
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
