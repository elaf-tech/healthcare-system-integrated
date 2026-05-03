<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TestResult;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;


class TestResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $currentUserId = Auth::user()->id;
    
    //     // البحث عن المريض الذي يمتلك نفس البريد الإلكتروني
    //     $test = TestResult::where('patient_id', $currentUserId)->first();
    
    //     // التحقق من وجود بيانات المريض
    //     if ($test) {
    //         return view('User.Test.index', compact('test'));
    //     } else {
    //         return view('User.Test.index')->with('message', 'لا توجد بيانات للمريض المرتبط بهذا البريد الإلكتروني.');
    //     }
    // }
    public function index()
{
    
        // إذا لم يتم تمرير patient_id، استرجع جميع التحاليل
        $tests = TestResult::where('patient_id', auth()->id())->get();    

    return view('User.Test.i', compact('tests'));
}
 /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $doctors=User::where('role', 1)->get();

        $patientId = auth()->user()->id;
        $patient = Patient::where('identity_number', $patientId)->first();
        // قم بإعداد البيانات اللازمة لعرض النموذج
        return view('User.Test.addTest', compact('patient','doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // تحقق من صحة البيانات
    $request->validate([
        'patient_id' => 'required|exists:patients,identity_number',
        // 'doctor_id' => 'required|exists:doctors,id',
        'test_type' => 'required|string|max:255',
        'test_date' => 'required|date',
        'result_value' => 'required|string|max:255',
        'unit' => 'nullable|string|max:50',
        'notes' => 'nullable|string|max:1000',
    ]);

    // إنشاء سجل جديد في جدول التحاليل
    TestResult::create([
        'patient_id' => $request->input('patient_id'),
        'user_id' => $request->input('doctor_id'),
        'test_type' => $request->input('test_type'),
        'test_date' => $request->input('test_date'),
        'result_value' => $request->input('result_value'),
        'unit' => $request->input('unit'),
        'notes' => $request->input('notes'),
    ]);

    // إعادة توجيه مع تمرير patient_id
    return redirect()->route('test.index')
                     ->with('success', __('web.testAddedSuccessfully'));
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // جلب نتيجة اختبار واحدة خاصة بالمريض
        $tests = TestResult::where('patient_id', $id)->first();    
    
        return view('User.Doctor.patientTest', compact('tests'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
