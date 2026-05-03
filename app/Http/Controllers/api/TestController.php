<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestResult;
use App\Models\Patient;
use App\Models\User;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        if (!$userId) {
            return response()->json(['error' => 'يجب تمرير user_id'], 400);
        }
    
        // جلب التحاليل مع بيانات الطبيب والمريض (علاقات doctor و patient)
        $tests = TestResult::with(['user', 'patient'])
        ->where('patient_id', $userId)
        ->get();
    
        // تجهيز الرد مع أسماء الطبيب والمريض
        $response = $tests->map(function ($test) {
            return [
                'id' => $test->id,
                'test_type' => $test->test_type,
                'test_date' => $test->test_date,
                'result_value' => $test->result_value,
                'unit' => $test->unit,
                'notes' => $test->notes,
                'doctor_name' => $test->user ? $test->user->name : 'غير معروف',
                'patient_name' => $test->patient ? $test->patient->full_name : 'غير معروف',
            ];
        });
    
        return response()->json($response);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            // 'patient_id' => 'required|string|exists:patients,identity_number',
            // 'doctor_id' => 'required|integer|exists:users,id',
            // 'test_type' => 'required|string',
            // 'test_date' => 'required|date',
            // 'result_value' => 'required|string',
            // 'unit' => 'nullable|string',
            // 'notes' => 'nullable|string',
        ]);
    
        $patient = Patient::where('identity_number', $request->patient_id)->first();
        if (!$patient) {
            return response()->json(['message' => 'المريض غير موجود'], 404);
        }
    
        $doctor = User::find($request->doctor_id);
        if (!$doctor) {
            return response()->json(['message' => 'الطبيب غير موجود'], 404);
        }
    
        $testResult = TestResult::create([
            'patient_id' => $patient->identity_number,
            'user_id' => $doctor->id,
            'test_type' => $request->test_type,
            'test_date' => $request->test_date,
            'result_value' => $request->result_value,
            'unit' => $request->unit,
            'notes' => $request->notes,
        ]);
    
        return response()->json([
            'message' => 'تم تسجيل التحليل بنجاح',
            'test_result' => $testResult
        ], 201);
    }
    


    
    

    

    
}
