<?php

namespace App\Models;

use App\Enums\RoleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['type'];

    protected $casts = [
        'type' => RoleStatus::class
    ];
}