<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'kit_id', 'test_type', 'results_data', 'released_at'
    ];

    protected $casts = [
        'results_data' => 'array',
        'released_at' => 'datetime',
    ];

    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }
}