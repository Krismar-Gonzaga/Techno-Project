<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = [
        'kit_code', 'patient_id', 'ordered_tests', 'status', 'collection_date'
    ];

    protected $casts = [
        'ordered_tests' => 'array',
        'collection_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}