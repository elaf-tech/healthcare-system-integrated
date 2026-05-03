<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class doctor_Week_schedule extends Model
{
    protected $fillable = [
        'doctor_id', 
        'day',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'is_active'
    ];
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
