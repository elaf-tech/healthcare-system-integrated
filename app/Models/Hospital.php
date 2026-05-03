<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'owner_name',
        'owner_phone',
        'address',
        'hospital_phone',
        'rating',
        'license_number',
        'license_date',
        'license_document',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
