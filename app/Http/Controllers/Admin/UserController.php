<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\TestResult;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب جميع المستخدمين
        $users = User::all();
        
        // حساب عدد المستخدمين حسب الـ role
        $regularUsersCount = User::where('role', 0)->count(); // المستخدمين العاديين
        $adminUsersCount = User::where('type', 1)->count(); // admins 
        $doctorsCount = User::where('role', 1)->count();      // الأطباء
        $patientcount=Patient::count();
        $testcount=TestResult::count();
        // حساب عدد الحجوزات (افترضنا أن لديك نموذج Booking)
        $bookingsCount = Appointment::count(); // إجمالي الحجوزات
        $concount=Message::count();

        
        $res = Appointment::with(['patient', 'user'])->get();
        $doc = User::where('role', 1)->get();
        $pat = Patient::all();
        $test = TestResult::with(['patient', 'user'])->get();
    
        return view('Admin.Users.index', compact(
            'users',
            'regularUsersCount',
            'adminUsersCount',
            'doctorsCount',
            'bookingsCount',
            'patientcount',
            'testcount',
            'concount',
            'res',
            'doc',
            'pat',
            'test'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Users.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required',
            'type' => 'required',
        ]);
    
        try {
            // تخزين الصورة في مجلد 'doctors'
            $imagePath = $request->file('image')->store('doctors', 'public');
    
            // تحديث المسار في البيانات المدخلة
            $validatedData['image'] = $imagePath; // استخدام المسار الكامل
    
            // تشفير كلمة المرور
            $validatedData['password'] = Hash::make($validatedData['password']);
            
            // إنشاء المستخدم
            $user = User::create($validatedData);
            
            return redirect()->route('admin.index')
                ->with('success', 'تمت إضافة المدير بنجاح');
    
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'حدث خطأ أثناء حفظ البيانات: ' . $e->getMessage());
        }
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
        $user=User::find($id);
        return view('Admin.Users.editUser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'المستخدم غير موجود');
        }
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required',
            'type' => 'required',
        ]);
    
        try {
            // إذا كانت هناك صورة جديدة، قم بتخزينها
            if ($request->hasFile('image')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                // تخزين الصورة الجديدة
                $imagePath = $request->file('image')->store('doctors', 'public');
                $validatedData['image'] = $imagePath; // تحديث المسار في البيانات المدخلة
            } else {
                // إذا لم يتم رفع صورة جديدة، احتفظ بالصورة القديمة
                $validatedData['image'] = $user->image;
            }
    
            // تحديث كلمة المرور إذا تم إدخالها
            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']); // إذا لم يتم إدخال كلمة مرور جديدة، احذفها من البيانات المدخلة
            }
    
            // تحديث بيانات المستخدم
            $user->update($validatedData);
    
            return redirect()->route('admin.index')->with('success', 'تم تحديث البيانات بنجاح');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء تحديث البيانات: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'المستخدم غير موجود');
        }
    
        try {
            // حذف الصورة من التخزين إذا كانت موجودة
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
    
            // حذف المستخدم من قاعدة البيانات
            $user->delete();
    
            return redirect()->route('admin.index')->with('success', 'تم حذف المستخدم بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء حذف المستخدم: ' . $e->getMessage());
        }
    }
}
