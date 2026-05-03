<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Patient;

// 🟢 تسجيل مستخدم جديد
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'تم التسجيل بنجاح',
        'user'    => $user,
        'token'   => $token,
    ], 201);
});

// 🟢 تسجيل دخول
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'بيانات الدخول غير صحيحة'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'تم تسجيل الدخول بنجاح',
        'user'    => $user,
        'token'   => $token,
    ], 200);
});

// 🟢 مسارات عامة (لا تحتاج توكن)
Route::get('/doctors', [App\Http\Controllers\Api\DoctorController::class, 'index']);
Route::post('/doctors', [App\Http\Controllers\Api\DoctorController::class, 'store']);
Route::get('/doctor/{id}/schedule', [App\Http\Controllers\Api\DoctorController::class, 'show']);
Route::post('/doctor/{id}/schedule', [App\Http\Controllers\Api\DoctorController::class, 'addSched']);

Route::delete('/schedule/{id}', [App\Http\Controllers\Api\DoctorScheduelController::class, 'destroy']);
Route::delete('/schedule/{id}/delete-part/{period}', [App\Http\Controllers\Api\DoctorScheduelController::class, 'deleteTimePart']);

// قائمة مختصرة بالدكاترة (فقط id و name)
Route::get('/doctors-short', function () {
    return \App\Models\User::where('role', 1)->get(['id', 'name']);
});

// البحث عن مريض برقم الهوية
Route::get('/patient/{identityNumber}', function($identityNumber) {
    $patient = Patient::where('identity_number', $identityNumber)->first();
    if ($patient) {
        return response()->json($patient);
    } else {
        return response()->json(['message' => 'Patient not found'], 404);
    }
});

// 🟢 مسارات خاصة تحتاج توكن
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'تم تسجيل الخروج بنجاح']);
    });

    // بيانات المستخدم الحالي + رقم الهوية (لو موجود)
    Route::get('/user', function (Request $request) {
        $user = Auth::user();
        $patient = $user->patient; // تأكدي عندك relation patient() في User

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'identity_number' => $patient ? $patient->identity_number : null,
        ]);
    });

    // إضافة مريض
    Route::post('/patients', [App\Http\Controllers\Api\PatientController::class, 'store'])->name('api.patients.store');

    Route::put('/appointments/{id}/complete', [App\Http\Controllers\Api\AppointmentController::class, 'markAsCompleted']);

    // مواعيد
    Route::post('/appointments', [App\Http\Controllers\Api\AppointmentController::class, 'store']);
    Route::get('/patient/{id}/appointments', [App\Http\Controllers\Api\AppointmentController::class, 'index']);
    Route::delete('/appointments/{id}', [App\Http\Controllers\Api\AppointmentController::class, 'destroy']);
    Route::get('doctor/{id}/appointments', [App\Http\Controllers\Api\AppointmentController::class, 'getDoctorAppointments']);
    Route::put('/appointments/{id}/confirm', [App\Http\Controllers\Api\AppointmentController::class, 'confirmAppointment']);
});
// مثال Route في routes/api.php
Route::get('/appointments/count', function (Illuminate\Http\Request $request) {
    $userId = $request->query('user_id');
    $count = \App\Models\Appointment::where('user_id', $userId)->count();
    return response()->json(['count' => $count]);
});
Route::get('/user/role', function (Illuminate\Http\Request $request) {
    $userId = $request->query('user_id');
    $user = \App\Models\User::find($userId);
    if ($user) {
        return response()->json(['role' => $user->role]);
    } else {
        return response()->json(['error' => 'User not found'], 404);
    }
});
// routes/api.php
Route::get('/patient/appointments/count', function (Request $request) {
    $patientId = $request->query('userId');
    $count = \App\Models\Appointment::where('patient_id', $patientId)->count();
    return response()->json(['count' => $count]);
});
Route::get('/appointments/confirmed/count', function (Illuminate\Http\Request $request) {
    $userId = $request->query('user_id');
    \Log::info('جاري الحساب للمريض:', ['user_id' => $userId]); // سطر طباعة للتأكد

    $count = \App\Models\Appointment::where('patient_id', $userId)
    ->where('status', 'confirmed')
    ->count();

    return response()->json(['count' => $count]);
});




// 🟢 التحاليل (بدون auth مؤقتًا)
Route::get('/tests', [App\Http\Controllers\Api\TestController::class, 'index']);
Route::post('/tests', [App\Http\Controllers\Api\TestController::class, 'store']);

// المواعيد المتاحة في جدول دكتور محدد
Route::get('/doctor/{doctorId}/schedule/{scheduleId}', [App\Http\Controllers\Api\AppointmentController::class, 'getAvailableSlots']);


Route::get('/check-patient-info', function (Request $request) {
    $userId = $request->query('user_id');

    $patient = \App\Models\Patient::where('user_id', $userId)->first();

    if ($patient) {
        return response()->json(['exists' => true]);
    } else {
        return response()->json(['exists' => false]);
    }
});
