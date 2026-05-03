<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // تأكد من إضافة هذا السطر

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'date_of_birth',
        'gender',
        'identity_number',
        'phone_number',
        'email',
        'address',
        'chronic_diseases',
        'current_medications',
        'allergies',
        'weight',
        'height',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'identity_number', 'id');
    }
    

}
