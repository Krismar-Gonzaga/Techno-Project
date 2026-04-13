<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'date_of_birth', 'pin', 'email', 'phone'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function kits()
    {
        return $this->hasMany(Kit::class);
    }
}