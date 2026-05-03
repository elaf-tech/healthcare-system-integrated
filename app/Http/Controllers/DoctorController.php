<?php

namespace App\Http\Controllers;
use App\Models\Hospital;

use App\Models\Doctor; // تأكد من استيراد النموذج
use App\Models\User; // تأكد من استيراد النموذج
use Illuminate\Support\Facades\Storage; // لاستعمال التخزين
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // استخدم paginate() بدلاً من get() للترقيم
        $doctors = User::where('role', 1)->paginate(10); // 10 أطباء لكل صفحة

        
        return view('User.Doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
 

    // عرض نموذج إضافة طبيب مع تمرير معلومات المستشفى
    return view('User.Doctor.DoctAdd');
}
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
        
    // // حفظ الصورة
    // $imagePath = $request->file('image')->store('doctors', 'public'); // تخزين الصورة في مجلد 'doctors'

    // // إنشاء سجل جديد في قاعدة البيانات
    // Doctor::create([
    //     'name' => $request->name,
    //     'specialization' => $request->specialization,
    //     'phone' => $request->phone,
    //     'email' => $request->email,
    //     'image' => $imagePath, // مسار الصورة المخزنة
    // ]);

    // // إعادة توجيه بعد النجاح
    // return redirect()->route('doctors.index')->with('success', 'تم إضافة الطبيب بنجاح.');
    // }
    public function store(Request $request)
{
    // تحقق من صحة المدخلات
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'specialization' => 'required|string',
        'phone' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // حفظ الصورة
    $imagePath = $request->file('image')->store('doctors', 'public'); // تخزين الصورة في مجلد 'doctors'

    // إنشاء سجل جديد في جدول المستخدمين
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password), // تشفير كلمة المرور
        'specialization' => $request->specialization,
        'phone' => $request->phone,
        'image' => $imagePath, // مسار الصورة المخزنة
        'role' => '1', // تعيين القيمة الافتراضية للدور
    ]);

    // إعادة توجيه بعد النجاح
    return redirect()->route('doctors.index')->with('success', 'تم إضافة الطبيب بنجاح.');
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
