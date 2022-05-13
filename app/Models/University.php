<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class University extends Authenticatable implements MustVerifyEmail 
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
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
