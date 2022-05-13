<?php

namespace App\Models;

use App\Models\Role;
use App\Enums\RoleStatus;
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
        'role_id'
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
        'email_verified_at' => 'datetime'
    ];

    public function role() {
        return $this->belongsTo(Role::class)->withDefault(['type' => RoleStatus::REDACTEUR]);
    }

    public function getIsAdminAttribute() {
        return $this->attributes['role_id'] === 1;
    }

    /**
     * Set Password attribute value
     */
    function setPasswordAttribute(string $value): void {
        $this->attributes['password'] = Hash::make($value);
    }
}
