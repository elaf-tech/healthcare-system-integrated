<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\User;

if (session()->has('app_locale')) {
    LaravelLocalization::setLocale(session('app_locale'));
} else {
    session(['app_locale' => config('app.locale')]);
}

// مسارات المصادقة (تسجيل دخول، تسجيل، إعادة تعيين كلمة المرور ...)
Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale()], function() {

    // تغيير اللغة (بدون حماية تسجيل دخول)
    Route::get('set-language/{lang}', function($lang) {
        session(['app_locale' => $lang]);
        return redirect()->back();
    });

    // مجموعة الروتات المحمية بميدل وير auth
    Route::middleware('auth')->group(function() {

        Route::get('/', function() {
            return view('User.index');
        });

        Route::get('/home', function() {
            return view('User.index');
        });

        // الموارد
        Route::resource('hospitals', App\Http\Controllers\HospitalController::class);
        Route::resource('doctors', App\Http\Controllers\DoctorController::class);
        Route::resource('docsche', App\Http\Controllers\DoctorScheduleController::class);

        Route::get('/doctors/{doctor}/schedules/create', [App\Http\Controllers\DoctorScheduleController::class, 'create'])->name('docsche.create');

        Route::resource('patients', App\Http\Controllers\PatientController::class);
        Route::resource('appointment', App\Http\Controllers\AppointmentController::class);

        Route::get('/appointments/create/{doctor}/{schedule}', [App\Http\Controllers\AppointmentController::class, 'create'])->name('appointment.create');
        Route::get('/appointments/cancel/{id}', [App\Http\Controllers\AppointmentController::class, 'cancel'])->name('appointment.cancel');
        Route::get('/appointment/info/{id}', [App\Http\Controllers\AppointmentController::class, 'showInfo'])->name('appointment.showInfo');
        Route::get('/appointment/confirm/{id}', [App\Http\Controllers\AppointmentController::class, 'confirm'])->name('appointment.confirm');
        Route::get('/appointment/completed/{id}', [App\Http\Controllers\AppointmentController::class, 'completed'])->name('appointment.completed');
        
        Route::resource('test', App\Http\Controllers\TestResultController::class);
        Route::resource('chat', App\Http\Controllers\ChatController::class);

        Route::get('/chat/{patient}', function (User $patient) {
            return view('chat', ['patient' => $patient]);
        });

        Route::post('/chat/{receiver}/mark-as-read', [App\Http\Controllers\ChatController::class, 'markAsRead'])->name('chat.markAsRead');
        Route::get('/chat/unread-count', [App\Http\Controllers\ChatController::class, 'unreadCount'])->name('chat.unreadCount');

        Route::resource('admin', App\Http\Controllers\Admin\UserController::class);

        /*
        // مثال على حماية حسب الدور (لو تستخدم spatie/laravel-permission مثلا)
        Route::middleware('role:admin')->group(function() {
            Route::resource('admin', App\Http\Controllers\Admin\UserController::class);
        });
        */
    });

});
