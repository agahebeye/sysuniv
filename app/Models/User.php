<?php

namespace App\Models;

use App\Enums\UserType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'website',
        'address',
        'suspended',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
        'email_verified_at' => 'datetime',
        'role' => UserType::class
    ];

    /**
     * Set Password attribute value
     */
    public function setPasswordAttribute(string $value): void {
        $this->attributes['password'] = Hash::make($value);
    }

    public function scopeUniversity(Builder $query) {
        return $query->where('role', UserType::UNIVERSITY);
    }

    public function scopeEmployee(Builder $query) {
        return $query->where('role', UserType::EMPLOYEE);
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
