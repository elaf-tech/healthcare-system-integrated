<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DoctorController extends Controller
{
    public function index()
    {
        // جلب المستخدمين اللي role = 1 (الأطباء)
        $doctors = User::where('role', 1)->get(['id', 'name', 'specialization', 'image','type']); // فقط الحقول اللازمة

        return response()->json([
            'success' => true,
            'data' => $doctors,
        ]);
    }
    
    public function store(Request $request)
    {
        // تحقق من صحة البيانات المرسَلة
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'specialization' => 'required|string',
            'phone' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // حفظ الصورة في storage/app/public/doctors
        $imagePath = $request->file('image')->store('doctors', 'public');
    
        // إنشاء مستخدم جديد في جدول users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'specialization' => $request->specialization,
            'phone' => $request->phone,
            'image' => $imagePath,
            'role' => 1, // الطبيب مثلاً
        ]);
    
        // ترجيع استجابة JSON (لأنها API)
        return response()->json([
            'message' => 'تم إضافة الطبيب بنجاح',
            'doctor' => $user
        ], 201);
    }


    public function show($id)
    {
        // جبنا الدكتور مع جدول المواعيد (schedules)
        $doctor = User::with(['schedules' => function($query) {
            // ترتيب الأيام مثل ما عملت في الـ View
            $query->orderByRaw("FIELD(day, 'saturday','sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday')");
        }])->find($id);

        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }

        return response()->json([
            'doctor' => [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'image' => $doctor->image ? asset('storage/' . $doctor->image) : null,
                'specialty' => $doctor->specialization,
            ],
            'schedules' => $doctor->schedules
        ]);
    }
    
    public function addSched(Request $request ,$id)
    {
        try {
            DB::beginTransaction();
    
            $doctorId = $id;
            $days = $request->days;       // مثال: days['sunday'] = 'sunday'
            $timeSlots = $request->time_slots; // نفس المفهوم
    
            $createdCount = 0;
    
            foreach ($timeSlots as $dayKey => $slot) {
                $appointmentData = [
                    'user_id' => $doctorId,
                    'day' => $days[$dayKey],  // مثلاً: 'sunday'
                    'morning_start' => $slot['morning_start'] ?? null,
                    'morning_end' => $slot['morning_end'] ?? null,
                    'afternoon_start' => $slot['afternoon_start'] ?? null,
                    'afternoon_end' => $slot['afternoon_end'] ?? null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
    
                if (!empty($appointmentData['morning_start']) && !empty($appointmentData['morning_end'])) {
                    DB::table('doctorschedule')->insert($appointmentData);
                    $createdCount++;
                }
            }
    
            DB::commit();
    
            if ($createdCount === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'لم يتم إضافة أي مواعيد، يرجى التأكد من إدخال الفترات الزمنية'
                ], 422);
            }
    
            return response()->json([
                'success' => true,
                'message' => "تم إضافة $createdCount موعد بنجاح"
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ: ' . $e->getMessage(),
            ], 500);
        }
    }
    
}
