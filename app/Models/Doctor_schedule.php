<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor_schedule extends Model
{
    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'session_type',
        'is_recurring',
        'valid_until'
    ];

    protected $casts = [
        'is_recurring' => 'boolean',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    // العلاقة مع الطبيب
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
