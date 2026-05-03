<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $table = 'doctorSchedule'; // تحديد اسم الجدول
    
    protected $fillable = [
        'user_id',
        'day',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'is_active'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
