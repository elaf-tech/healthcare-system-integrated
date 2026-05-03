<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestResult extends Model
{
    use HasFactory;

    // تحديد الاسم الخاص بالجدول إذا لم يكن مطابقًا لاسم النموذج بصيغة الجمع
    protected $table = 'test_results';

    // تحديد الأعمدة القابلة للتعبئة
    protected $fillable = [
        'patient_id',
        'user_id',
        'test_type',
        'test_date',
        'result_value',
        'unit',
        'notes',
    ];

    // علاقة مع نموذج Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'identity_number');
    }

    // علاقة مع نموذج Doctor
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
