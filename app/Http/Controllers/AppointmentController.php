<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patientId = Auth::user()->id;
        $patient = Patient::where('identity_number', $patientId)->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'لم يتم العثور على بيانات المريض');
        }

        $appointments = Appointment::with('user')
        ->where('patient_id', $patient->identity_number)
        ->orderBy('day', 'asc')
            ->orderBy('time', 'asc')
            ->paginate(10);    

        return view('User.Appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create($doctorId, $scheduleId)
    // {
    //     $doctor = Doctor::findOrFail($doctorId);
    //     $schedule = DoctorSchedule::findOrFail($scheduleId);
    //     $patient = Patient::where('identity_number', auth()->id())->first();

    //     // الحصول على المواعيد المحجوزة مسبقاً لهذا الطبيب في هذا اليوم
    //     $bookedAppointments = Appointment::where('doctor_id', $doctorId)
    //         ->where('day', $schedule->day)
    //         ->pluck('time')
    //         ->toArray();

    //     // توليد الأوقات المتاحة
    //     $morningSlots = $this->getAvailableSlots($schedule->morning_start, $schedule->morning_end, $bookedAppointments);
    //     $afternoonSlots = $this->getAvailableSlots($schedule->afternoon_start, $schedule->afternoon_end, $bookedAppointments);

    //     return view('User.Appointment.addApp', compact(
    //         'doctor', 
    //         'schedule', 
    //         'patient', 
    //         'morningSlots', 
    //         'afternoonSlots'
    //     ));
    // }
    public function create($doctorId, $scheduleId)
    {
        $doctor = User::findOrFail($doctorId);
        $schedule = DoctorSchedule::findOrFail($scheduleId);
        // $patient = Patient::where('identity_number', auth()->id())->first();
        $patient = Patient::where('identity_number', Auth::user()->id)->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'لم يتم العثور على بيانات المريض');
        }
    
        // الحصول على المواعيد المحجوزة مسبقاً لهذا الطبيب في هذا اليوم
        $bookedAppointments = Appointment::where('user_id', $doctorId)
            ->where('day', $schedule->day)
            ->pluck('time')
            ->toArray();
    
        // إذا كانت هناك فترة محررة حديثاً، نضيفها للقائمة
        if (session('released_slot')) { // تم إضافة قوس الإغلاق هنا
            $released = session('released_slot');
            if ($released['user_id'] == $doctorId && $released['day'] == $schedule->day) {
                $bookedAppointments = array_diff($bookedAppointments, [$released['time']]);
            }
        }
    
        // توليد الأوقات المتاحة
        $morningSlots = $this->getAvailableSlots(
            $schedule->morning_start, 
            $schedule->morning_end, 
            $bookedAppointments
        );
        
        $afternoonSlots = $this->getAvailableSlots(
            $schedule->afternoon_start, 
            $schedule->afternoon_end, 
            $bookedAppointments
        );
    
        return view('User.Appointment.addApp', compact(
            'doctor', 
            'schedule', 
            'patient', 
            'morningSlots', 
            'afternoonSlots'
        ));
    }
    // private function getAvailableSlots($startTime, $endTime, $bookedAppointments)
    // {
    //     if (!$startTime || !$endTime) {
    //         return [];
    //     }

    //     $slots = [];
    //     $current = strtotime($startTime);
    //     $end = strtotime($endTime);

    //     while ($current <= $end) {
    //         $time = date('H:i:s', $current);
    //         if (!in_array($time, $bookedAppointments)) {
    //             $slots[] = $time;
    //         }
    //         $current = strtotime('+30 minutes', $current);
    //     }

    //     return $slots;
    // }

    private function getAvailableSlots($startTime, $endTime, $bookedAppointments)
{
    if (!$startTime || !$endTime) {
        return [];
    }

    $slots = [];
    $current = Carbon::parse($startTime);
    $end = Carbon::parse($endTime);

    // تحويل المواعيد المحجوزة إلى كاربون لتسهيل المقارنة
    $bookedTimes = array_map(function($time) {
        return Carbon::parse($time);
    }, $bookedAppointments);

    while ($current <= $end) {
        $timeStr = $current->format('H:i:s');
        
        // التحقق إذا كان الوقت غير محجوز
        $isBooked = false;
        foreach ($bookedTimes as $booked) {
            if ($booked->format('H:i:s') === $timeStr) {
                $isBooked = true;
                break;
            }
        }
        
        if (!$isBooked) {
            $slots[] = $timeStr;
        }
        
        $current->addMinutes(30);
    }

    return $slots;
}
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'patient_id' => 'required|exists:patients,identity_number',
    // 'user_id' => 'required|exists:users,id',
    // 'day' => 'required|string',
    // 'time' => 'required|date_format:H:i:s',
    // 'schedule_id' => 'required|exists:doctor_schedules,id',
    //     ]);

    //     // التحقق من عدم وجود حجز مسبق لنفس الطبيب في نفس اليوم والوقت
    //     $existingAppointment = Appointment::where('user_id', $request->doctor_id)
    //         ->where('day', $request->day)
    //         ->where('time', $request->time)
    //         ->first();

    //     if ($existingAppointment) {
    //         return back()->with('error', 'هذا الموعد محجوز بالفعل!')->withInput();
    //     }

    //     try {
    //         // إنشاء الموعد الجديد
    //         Appointment::create([
    //             'patient_id' => $request->patient_id,
    //             'user_id' => $request->user_id,
    //             'day' => $request->day,
    //             'time' => $request->time,
    //             'status' => 'pending', // أو 'pending' حسب نظامك
    //         ]);

    //         return redirect()->route('docsche.show', $request->user_id)
    //             ->with('success', 'تم حجز الموعد بنجاح!');

    //     } catch (\Exception $e) {
    //         return back()->with('error', 'حدث خطأ أثناء حجز الموعد: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }
    public function store(Request $request)
    {
        // تأكد وجود المريض
        $patientExists = \App\Models\Patient::where('identity_number', $request->patient_id)->exists();
    
        // تأكد وجود الطبيب
        $userExists = \App\Models\User::where('id', $request->user_id)->exists();
    
        // تأكد وجود الجدول الزمني
        $scheduleExists = \App\Models\DoctorSchedule::where('id', $request->schedule_id)->exists();
    
        if (!$patientExists || !$userExists || !$scheduleExists) {
            return back()->with('error', 'البيانات المدخلة غير صحيحة')->withInput();
        }
    
        // التحقق من موعد محجوز مسبقًا
        $existingAppointment = Appointment::where('user_id', $request->user_id)
            ->where('day', $request->day)
            ->where('time', $request->time)
            ->first();
    
        if ($existingAppointment) {
            return back()->with('error', 'هذا الموعد محجوز بالفعل!')->withInput();
        }
    
        try {
            Appointment::create([
                'patient_id' => $request->patient_id,
                'user_id' => $request->user_id,
                'day' => $request->day,
                'time' => $request->time,
                'status' => 'pending',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'خطأ أثناء الحجز: ' . $e->getMessage())->withInput();
        }
    
        return redirect()->route('docsche.show', $request->user_id)
            ->with('success', 'تم حجز الموعد بنجاح!');
    }
    

    /**
     * Cancel the specified appointment.
     */
    // public function cancel($id)
    // {
    //     $appointment = Appointment::findOrFail($id);
    //     $appointment->status = 'ملغي'; // تغيير حالة الموعد إلى "ملغي"
    //     $appointment->save();

    //     // هنا يمكنك إضافة منطق لإعادة الفترة المحجوزة إلى قائمة الفترات المتاحة
    //     // لا تحتاج إلى أي إجراء إضافي إذا كان لديك نظام ديناميكي لإدارة الفترات

    //     return redirect()->back()->with('success', 'تم إلغاء الموعد بنجاح');
    // }
    /**
 * Cancel the specified appointment.
 */
public function cancel($id)
{
    $appointment = Appointment::findOrFail($id);
    
    // تخزين بيانات الموعد قبل الحذف
    $doctorId = $appointment->doctor_id;
    $day = $appointment->day;
    $time = $appointment->time;
    
    // حذف الموعد بدلاً من تغيير حالته
    $appointment->delete();

    // يمكنك إضافة إشعار للمريض هنا إذا لزم الأمر
    
    return redirect()->back()
        ->with('success', 'تم إلغاء الموعد بنجاح')
        ->with('released_slot', ['doctor_id' => $doctorId, 'day' => $day, 'time' => $time]);
}

public function show(string $id)
{
    // استرجاع جميع الحجوزات التي تخص الطبيب المحدد
    $appointments = Appointment::with('patient') // افترض أن هناك علاقة بين Appointment و Patient
        ->where('user_id', $id)
        ->orderBy('day', 'asc')
        ->orderBy('time', 'asc')
        ->paginate(10); // يمكنك تعديل عدد العناصر في الصفحة حسب الحاجة

    return view('User.Appointment.DoctApp', compact('appointments'));
}

public function showInfo($id)
{
    // استرجاع معلومات المريض باستخدام المعرف
    $patient = Patient::findOrFail($id);

    // التحقق من وجود بيانات المريض
    if ($patient) {
        return view('User.Appointment.patientInfo', compact('patient'));
    } else {
        return view('User.Appointment.patientInfo')->with('message', 'لا توجد بيانات للمريض المرتبط بهذا البريد الإلكتروني.');
    }
    return view('User.Appointment.patientInfo', compact('patient'));
}
public function confirm($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'confirmed'; // تحديث الحالة إلى "confirmed"
    $appointment->save();

    return redirect()->back()->with('success', 'تم تأكيد الموعد بنجاح!');
}

public function completed($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'completed'; // تحديث الحالة إلى "confirmed"
    $appointment->save();

    return redirect()->back()->with('success', 'تم تأكيد الموعد بنجاح!');
}
}