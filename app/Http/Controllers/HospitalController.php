<?php

namespace App\Http\Controllers;
use App\Models\Hospital;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::query()->paginate(10);;

        return view('User.Hospital.index',compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.Hospital.HosAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // إنشاء مستشفى جديد
    $hospital = new Hospital();
    $hospital->name = $request->name;
    $hospital->license_number = $request->license_number;
    $hospital->address = $request->address;
    $hospital->hospital_phone = $request->hospital_phone;
    $hospital->owner_name = $request->owner_name;
    $hospital->owner_phone = $request->owner_phone;
    $hospital->license_date = $request->license_date;
    $hospital->user_id = auth()->id(); // تأكد من أن المستخدم مسجل الدخول

    // معالجة صورة المستشفى
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('hospitals', 'public');
        $hospital->image = $imagePath;
    }

    // معالجة وثيقة الترخيص
    if ($request->hasFile('license_document')) {
        $documentPath = $request->file('license_document')->store('licenses', 'public');
        $hospital->license_document = $documentPath;
    }

    // حفظ المستشفى في قاعدة البيانات
    $hospital->save();

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('hospitals.index')->with('success', 'تم إضافة المستشفى بنجاح.');
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
        $hospital=Hospital::find($id);
       return view('User.Hospital.Hosedit', compact('hospital'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hospital = Hospital::findOrFail($id);

    // تحديث البيانات
    $hospital->name = $request->name;
    $hospital->license_number = $request->license_number;
    $hospital->address = $request->address;
    $hospital->hospital_phone = $request->hospital_phone;
    $hospital->owner_name = $request->owner_name;
    $hospital->owner_phone = $request->owner_phone;
    $hospital->license_date = $request->license_date;

    // معالجة ملف الصورة
     // معالجة ملف الصورة
     if ($request->hasFile('image')) {
        // حذف الصورة القديمة إذا كانت موجودة
        if ($hospital->image) {
            Storage::delete($hospital->image);
        }
        $hospital->image = $request->file('image')->store('hospitals', 'public');
    }

    // معالجة وثيقة الترخيص
    if ($request->hasFile('license_document')) {
        // حذف الوثيقة القديمة إذا كانت موجودة
        if ($hospital->license_document) {
            Storage::delete($hospital->license_document);
        }
        $hospital->license_document = $request->file('license_document')->store('licenses', 'public');
    } else {
        // احتفظ بالقيمة القديمة إذا لم يتم تحميل وثيقة جديدة
        $hospital->license_document = $hospital->getOriginal('license_document');
    }

    // حفظ التغييرات
    $hospital->save();

    // إعادة توجيه مع رسالة نجاح
    return redirect()->route('hospitals.index')->with('success', __('web.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showDoctors($id)
    {
        $hospital = Hospital::findOrFail($id);
        $doctors = $hospital->doctors;
        $user = Auth::user();
        
        return view('User.Hospital.showDoctors', [
            'hospital' => $hospital,
            'doctors' => $doctors,
            'currentUserEmail' => $user ? $user->email : null
        ]);
    }
}
