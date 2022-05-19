<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'firstname',
        'lastnmame',
        'gender',
        'birth_date',
        'address'
    ];

    protected $casts = [
        'birth_date' => 'datetime'
    ];

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
