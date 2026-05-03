<?php

namespace App\Http\Controllers;
use App\Models\Doctor;

use Illuminate\Http\Request;

class Doctor_scheduleController extends Controller
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
        // جلب المستشفى بناءً على المعرف
        $doctor = Doctor::findOrFail($doctorId);
        
        // جلب جميع المستشفيات (إذا كنت بحاجة لذلك)
        // $hospitals = Hospital::all();
    
        // عرض نموذج إضافة طبيب مع تمرير معلومات المستشفى
        return view('User.Doctor.addApp', compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
