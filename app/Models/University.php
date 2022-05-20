<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;

class University extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

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
            fn ($university) =>
            $university->setId(Str::random(6))
        );
    }



    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function faculties() {
        return $this->belongsToMany(Faculty::class, 'universities_faculties');
    }

    public function institutes() {
        return $this->belongsToMany(Institute::class, 'universities_institutes');
    }

    public function students() {
        return $this->belongsToMany(Student::class, 'registrations');
    }
}
