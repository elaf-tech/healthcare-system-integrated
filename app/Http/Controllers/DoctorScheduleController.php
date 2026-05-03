<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($doctorId)
{
    // Use find() instead of findOrFail() if you want to handle missing doctors gracefully
    $doctor = User::find($doctorId);
    
    if (!$doctor) {
        // Handle the case where doctor isn't found - maybe redirect with an error
        return redirect()->back()->with('error', 'Doctor not found');
    }

    // If you're expecting multiple doctors, use where() or get()
    // $doctors = Doctor::where('some_condition', $value)->get();
    
    return view('User.Doctor.addApp', compact('doctor'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $doctorId = $request->doctor_id;
            $days = $request->days; // مثل days[sunday]=sunday
            $timeSlots = $request->time_slots;
    
            $createdCount = 0;
    
            foreach ($timeSlots as $dayKey => $slot) {
                $appointmentData = [
                    'user_id' => $doctorId,
                    'day' => $days[$dayKey],  // سيصل هنا days[sunday]=sunday
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
                return back()
                    ->withInput()
                    ->with('error', 'لم يتم إضافة أي مواعيد، يرجى التأكد من إدخال الفترات الزمنية');
            }
    
            return redirect()
                ->route('docsche.show', ['doctor' => $doctorId])
                ->with('success', "تم إضافة $createdCount موعد بنجاح");
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = User::with(['schedules' => function($query) {
            $query->orderByRaw("FIELD(day, 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday')");
        }])->findOrFail($id);
    
        return view('User.Doctor.scedules', [
            'doctor' => $doctor,
            'schedules' => $doctor->schedules
        ]);
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
    try {
        $deleted = DB::table('doctorSchedule')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'تم حذف الموعد بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لم يتم العثور على الموعد.');
        }
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() == '23000') {
            return redirect()->back()->with('error', 'لا يمكن حذف الموعد لأنه مرتبط بسجلات أخرى.');
        }
        return redirect()->back()->with('error', 'حدث خطأ أثناء الحذف: ' . $e->getMessage());
    }
}

}
