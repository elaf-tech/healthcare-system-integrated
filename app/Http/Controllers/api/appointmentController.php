<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\DoctorSchedule;
use App\Models\Patient;

class AppointmentController extends Controller
{
    // في الكنترولر
public function index($id)
{
    // $id هنا هو user_id
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'لم يتم العثور على المستخدم'], 404);
    }

    // نفترض أن عندك علاقة user->patient
    $patient = $user->patient;

    if (!$patient) {
        return response()->json(['error' => 'لم يتم العثور على بيانات المريض'], 404);
    }

    $appointments = Appointment::with('user')
    //$appointments = Appointment::with('user')
    ->where('patient_id', $patient->identity_number)  // استخدم رقم الهوية وليس id
    ->orderBy('day', 'asc')
    ->orderBy('time', 'asc')
    ->paginate(10);

    // نعدل البيانات قبل الإرجاع
    $appointments->getCollection()->transform(function ($appointment) {
        return [
            'id'           => $appointment->id,
            'doctor_name'  => $appointment->user->name ?? 'غير معروف',
            'doctor_image' => $appointment->user->image 
                ? asset('storage/' . $appointment->user->image)
                : 'https://via.placeholder.com/150',
            'day'          => $appointment->day ?? null,
            'time'         => $appointment->time,
            'status'       => $appointment->status,
        ];
    });

    return response()->json($appointments);
}

    

    
public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);
    
    // Add authorization check if needed
    if ($appointment->patient_id != auth()->user()->patient->identity_number) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }
    

    $appointment->delete();
    
    return response()->json(['message' => 'تم إلغاء الموعد بنجاح']);
}



    public function store(Request $request)
    {
        $request->validate([
            'patient_id'   => 'required',
            'user_id'      => 'required|exists:users,id',
            'day'          => 'required|string',
            'time'         => 'required|string',
        ]);

        $patientExists = Patient::where('identity_number', $request->patient_id)->exists();
        if (!$patientExists) {
            return response()->json(['error' => 'رقم هوية المريض غير صحيح'], 400);
        }

        // التأكد من عدم وجود موعد بنفس اليوم والوقت مع نفس الدكتور
        $existingAppointment = Appointment::where('user_id', $request->user_id)
            ->where('day', $request->day)
            ->where('time', $request->time)
            ->first();

        if ($existingAppointment) {
            return response()->json(['error' => 'هذا الموعد محجوز بالفعل!'], 409);
        }

        try {
            Appointment::create([
                'patient_id' => $request->patient_id,
                'user_id'    => $request->user_id,
                'day'        => $request->day,
                'time'       => $request->time,
                'status'     => 'pending',
            ]);
            return response()->json(['success' => 'تم حجز الموعد بنجاح!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ أثناء الحجز: ' . $e->getMessage()], 500);
        }
    }

    public function getAvailableSlots($doctorId, $scheduleId)
    {
        $doctor = User::findOrFail($doctorId);
        $schedule = DoctorSchedule::findOrFail($scheduleId);

        $bookedAppointments = Appointment::where('user_id', $doctorId)
            ->where('day', $schedule->day)
            ->pluck('time')
            ->toArray();

        // إذا كان في جلسة وقت تم تحريره، احذفه من قائمة الأوقات المحجوزة
        if (session('released_slot')) {
            $released = session('released_slot');
            if ($released['user_id'] == $doctorId && $released['day'] == $schedule->day) {
                $bookedAppointments = array_diff($bookedAppointments, [$released['time']]);
            }
        }

        $morningSlots = $this->generateAvailableSlots(
            $schedule->morning_start, 
            $schedule->morning_end, 
            $bookedAppointments
        );

        $afternoonSlots = $this->generateAvailableSlots(
            $schedule->afternoon_start, 
            $schedule->afternoon_end, 
            $bookedAppointments
        );

        return response()->json([
            'doctor'        => $doctor,
            'schedule'      => $schedule,
            'morningSlots'  => $morningSlots,
            'afternoonSlots'=> $afternoonSlots
        ]);
    }

    // توليد الأوقات المتاحة بناءً على البداية والنهاية والأوقات المحجوزة
    private function generateAvailableSlots($startTime, $endTime, $bookedAppointments)
    {
        $slots = [];
        if (!$startTime || !$endTime) {
            return $slots;
        }

        $current = strtotime($startTime);
        $end = strtotime($endTime);

        while ($current < $end) {
            $time = date('H:i', $current);
            if (!in_array($time, $bookedAppointments)) {
                $slots[] = $time;
            }
            // نفترض أن الموعد مدته 30 دقيقة، يمكنك التعديل حسب الحاجة
            $current = strtotime('+30 minutes', $current);
        }

        return $slots;
    }


    public function getDoctorAppointments($id)
{
    $appointments = Appointment::with('patient')
    ->where('user_id', $id)
    ->orderBy('day', 'asc')
    ->orderBy('time', 'asc')
    ->get();

// ممكن تعيد صياغتها بهذا الشكل:
$appointments = $appointments->map(function ($appointment) {
    return [
        'id' => $appointment->id,
        'patient_name' => $appointment->patient->full_name ?? 'غير معروف',
        'day' => $appointment->day,
        'time' => $appointment->time, // لازم يكون بنص مثل "15:30"
        'status' => $appointment->status,
    ];
});


    return response()->json([
        'success' => true,
        'data' => $appointments
    ]);
}

public function confirmAppointment($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'confirmed';
    $appointment->save();

    return response()->json(['success' => true, 'message' => 'تم تأكيد الحجز بنجاح']);
}
public function confirmedAppointmentsCount(Request $request)
{
    $userId = $request->input('user_id');

    $count = Appointment::where('patient_id', $userId)
                ->where('status', 'confirmed')
                ->count();

    return response()->json([
        'status' => 'success',
        'confirmed_appointments_count' => $count,
    ]);
}
public function markAsCompleted($id)
{
    $appointment = Appointment::find($id);

    if (!$appointment) {
        return response()->json(['success' => false, 'message' => 'الموعد غير موجود'], 404);
    }

    $appointment->status = 'completed';
    $appointment->save();

    return response()->json(['success' => true, 'message' => 'تمت المعاينة بنجاح']);
}


}
