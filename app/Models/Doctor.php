<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'specialization', 'image','email','phone']; // إضافة الصورة هنا

    // public function hospital()
    // {
    //     return $this->belongsTo(Hospital::class);
    // }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // app/Models/Doctor.php
    // public function schedules()
    // {
    //     return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    // }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}
