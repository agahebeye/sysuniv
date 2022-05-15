<?php

namespace App\Models;

use App\Models\Role;
use App\Enums\RoleStatus;
use App\Enums\UserType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
        'is_admin'
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
        'is_admin' => UserType::class
    ];

    public function getIsAdminAttribute() {
        return $this->attributes['is_admin'] === UserType::ADMIN;
    }

    /**
     * Set Password attribute value
     */
    function setPasswordAttribute(string $value): void {
        $this->attributes['password'] = Hash::make($value);
    }
}
