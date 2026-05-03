<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        // الحصول على البريد الإلكتروني للمستخدم الحالي
        $currentUserId = Auth::user()->id;
    
        // البحث عن المريض الذي يمتلك نفس البريد الإلكتروني
        $patient = Patient::where('identity_number', $currentUserId)->first();
    
        // التحقق من وجود بيانات المريض
        if ($patient) {
            return view('User.Patient.index', compact('patient'));
        } else {
            return view('User.Patient.index')->with('message', 'لا توجد بيانات للمريض المرتبط بهذا البريد الإلكتروني.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.Patient.addPatient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من صحة المدخلات
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone_number' => 'required|string',
            'address' => 'nullable|string',
            'chronic_diseases' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'allergies' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ]);
    
        // إضافة قيم identity_number و email
        $validatedData['identity_number'] = auth()->id();
        $validatedData['email'] = auth()->user()->email;
    
        // إنشاء مريض جديد باستخدام البيانات المدخلة
        Patient::create($validatedData);
    
        // إعادة توجيه المستخدم مع رسالة نجاح
        return redirect()->route('patients.index')->with('success', 'تم إضافة المريض بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient=Patient::findOrFail($id);
        return view('User.Patient.editPatient',compact('patient'));
      
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // التحقق من صحة المدخلات
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'gender' => 'required|in:male,female,other',
        'identity_number' => 'nullable|string',
        'phone_number' => 'nullable|string',
        'email' => 'nullable|email',
        'address' => 'nullable|string',
        'chronic_diseases' => 'nullable|string',
        'current_medications' => 'nullable|string',
        'allergies' => 'nullable|string',
        'weight' => 'nullable|numeric',
        'height' => 'nullable|numeric',
    ]);

    // العثور على المريض وتحديث البيانات
    $patient = Patient::findOrFail($id);
    $patient->update($validatedData);

    // إعادة توجيه المستخدم مع رسالة نجاح
    return redirect()->route('patients.index')->with('success', 'تم تحديث بيانات المريض بنجاح!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
