<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorSchedule; // تأكد من استيراد النموذج
use Illuminate\Support\Facades\DB;

class DoctorScheduelController extends Controller
{
  public function destroy($id)
{
    $schedule = DB::table('doctorSchedule')->where('id', $id)->first();
    
    if (!$schedule) {
        return response()->json(['error' => 'الموعد غير موجود'], 404);
    }

    DB::table('doctorSchedule')->where('id', $id)->delete();

    return response()->json(['success' => 'تم حذف الموعد بنجاح']);
}
public function deleteTimePart($id, $period)
{
    $schedule = DoctorSchedule::findOrFail($id);

    if ($period === 'morning') {
        $schedule->morning_start = null;
        $schedule->morning_end = null;
    } elseif ($period === 'afternoon') {
        $schedule->afternoon_start = null;
        $schedule->afternoon_end = null;
    } else {
        return response()->json(['success' => false, 'message' => 'نوع غير صالح'], 400);
    }

    $schedule->save();

    return response()->json(['success' => true, 'message' => 'تم حذف الفترة بنجاح']);
}

}
