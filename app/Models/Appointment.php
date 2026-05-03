<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'time',
        'day',
        'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'identity_number');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
