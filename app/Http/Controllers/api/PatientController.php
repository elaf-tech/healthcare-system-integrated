<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    
    public function store(Request $request)
{
    // التحقق من صحة المدخلات
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'gender' => 'required|in:male,female',
        'phone_number' => 'required|string',
        'address' => 'nullable|string',
        'chronic_diseases' => 'nullable|string',
        'current_medications' => 'nullable|string',
        'allergies' => 'nullable|string',
        'weight' => 'nullable|numeric',
        'height' => 'nullable|numeric',
        'identity_number' => 'required|string',   // تأكد من إرسالها من Flutter
    ]);

    // يمكنك هنا إضافة البريد الالكتروني من المستخدم المسجل
    $validatedData['email'] = auth()->user()->email ?? null;

    // إنشاء المريض
    Patient::create($validatedData);

    return response()->json(['message' => 'تم إضافة المريض بنجاح!'], 201);
}

}
