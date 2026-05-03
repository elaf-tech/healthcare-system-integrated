@extends('User.master')
<base href="/public">

@section('content')
@php
    \Carbon\Carbon::setLocale('ar');
    setlocale(LC_TIME, 'ar_SA.utf8');
    
    $dayMap = [
        'السبت' => 'Saturday',
        'الأحد' => 'Sunday',
        'الإثنين' => 'Monday',
        'الثلاثاء' => 'Tuesday',
        'الأربعاء' => 'Wednesday',
        'الخميس' => 'Thursday',
        'الجمعة' => 'Friday'
    ];
@endphp

<div class="luxury-schedule-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <!-- Luxury Doctor Header -->
    <div class="luxury-doctor-header" style="color:white;    background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);">
        <div class="luxury-overlay"></div>
        <div class="container position-relative">
            <div class="luxury-doctor-profile">
                <div class="luxury-avatar-frame">
                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="luxury-doctor-avatar">
                    <div class="luxury-verification-badge">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="luxury-doctor-info" >
                    <h1 class="luxury-doctor-name">د. {{ $doctor->name }}</h1>
                    <p class="luxury-specialty">{{ $doctor->specialty }}</p>
                    {{-- <div class="luxury-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="rating-text">4.9 (128 تقييم)</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Luxury Action Bar -->
    <div class="luxury-action-bar">
        <div class="container">
            <div class="">
                @if(auth()->user()->role == 1)

                <div class="d-flex justify-content-center my-4"> <!-- Center the button -->
                    <a href="{{ route('docsche.create', $doctor->id) }}" class="luxury-btn luxury-primary-btn btn-lg"> <!-- Add btn-lg for larger size -->
                        <i class="fas fa-plus-circle"></i> {{__('web.addSched')}}
                    </a>
                </div>
                @endif
                {{-- <div class="luxury-action-icons">
                    <button class="luxury-icon-btn">
                        <i class="fas fa-print"></i>
                    </button>
                    <button class="luxury-icon-btn">
                        <i class="fas fa-share-alt"></i>
                    </button>
                    <button class="luxury-icon-btn">
                        <i class="fas fa-calendar-alt"></i>
                    </button>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Luxury Schedule Timeline -->
    <div class="container luxury-schedule-wrapper">
        <div class="luxury-week-navigation">
            {{-- <button class="luxury-nav-btn">
                <i class="fas fa-chevron-right"></i> الأسبوع الماضي
            </button>
            <div class="luxury-current-week">
                <i class="fas fa-calendar-week"></i> الأسبوع الحالي
            </div>
            <button class="luxury-nav-btn">
                الأسبوع القادم <i class="fas fa-chevron-left"></i>
            </button> --}}
        </div>

        <div class="luxury-schedule-timeline">
            @foreach($schedules as $schedule)
            @php
                $nextDay = \Carbon\Carbon::now()->next($dayMap[$schedule->day] ?? 'Monday');
            @endphp
            <div class="luxury-day-card {{ $schedule->is_active ? 'active' : 'inactive' }}">
                <div class="luxury-day-header">
                    <div class="luxury-day-name">
                        <h3>{{ __('days.days.' .  $schedule->day )}}</h3>
                        {{-- <p>{{ $nextDay->translatedFormat('d F Y') }}</p> --}}
                    </div>
                    <div class="luxury-day-status {{ $schedule->is_active ? 'active' : 'inactive' }}">
                        {{ $schedule->is_active ? 'متاح للحجز' : 'مغلق' }}
                    </div>
                </div>

                <div class="luxury-time-slots">
                    <!-- Morning Session -->
                    <div class="luxury-time-slot morning">
                        <div class="luxury-slot-header">
                            <i class="fas fa-sun"></i>
                            <h4>الفترة الصباحية</h4>
                        </div>
                        @if($schedule->morning_start && $schedule->morning_end)
                        <div class="luxury-slot-time">
                            {{ \Carbon\Carbon::parse($schedule->morning_start)->format('h:i A') }} - 
                            {{ \Carbon\Carbon::parse($schedule->morning_end)->format('h:i A') }}
                        </div>
                        <div class="luxury-progress-bar">
                            <div class="luxury-progress-fill" style="width: 100%"></div>
                        </div>
                        @else
                        <div class="luxury-slot-unavailable">
                            <i class="fas fa-ban"></i> غير متاح
                        </div>
                        @endif
                    </div>

                    <!-- Afternoon Session -->
                    <div class="luxury-time-slot afternoon">
                        <div class="luxury-slot-header">
                            <i class="fas fa-moon"></i>
                            <h4>الفترة المسائية</h4>
                        </div>
                        @if($schedule->afternoon_start && $schedule->afternoon_end)
                        <div class="luxury-slot-time">
                            {{ \Carbon\Carbon::parse($schedule->afternoon_start)->format('h:i A') }} - 
                            {{ \Carbon\Carbon::parse($schedule->afternoon_end)->format('h:i A') }}
                        </div>
                        <div class="luxury-progress-bar">
                            <div class="luxury-progress-fill" style="width: 100%"></div>
                        </div>
                        @else
                        <div class="luxury-slot-unavailable">
                            <i class="fas fa-ban"></i> غير متاح
                        </div>
                        @endif
                    </div>
                </div>

                <div class="luxury-day-footer">
                    @if($schedule->is_active)
                    @php
    $patientExists = \App\Models\Patient::where('identity_number', auth()->user()->id)->exists();
@endphp

    <a href="{{ $patientExists ? route('appointment.create', ['doctor' => $doctor->id, 'schedule' => $schedule->id]) : route('patients.index') }}" class="luxury-book-btn">
        <i class="far fa-calendar-check"></i> حجز موعد
    </a>
    @if(auth()->user()->role == 1)
    <div class="d-flex justify-content-center my-4">
        <form action="{{ route('docsche.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف الموعد؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="luxury-btn luxury-danger-btn btn-lg">
                <i class="fas fa-minus-circle"></i> {{ __('web.SchedDel') }}
            </button>
        </form>
    </div>
@endif

    {{-- <i class="far fa-calendar-check"></i> حجز موعد
</a> --}}
                    @else
                    <button class="luxury-disabled-btn" disabled>
                        <i class="fas fa-lock"></i> غير متاح للحجز
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Luxury Doctor Details -->
    <div class="luxury-details-container">
        <div class="container">
            <div class="luxury-details-grid">
                <!-- Clinic Information -->
                <div class="luxury-detail-card">
                    <div class="luxury-card-header">
                        <i class="fas fa-clinic-medical"></i>
                        <h3>معلومات العيادة</h3>
                    </div>
                    <div class="luxury-card-body">
                        <div class="luxury-detail-item">
                            <div class="luxury-detail-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="luxury-detail-content">
                                <h4>الموقع</h4>
                                <p>مستشفى المدينة الطبي، الطابق الثالث، العيادة 12</p>
                            </div>
                        </div>
                        <div class="luxury-detail-item">
                            <div class="luxury-detail-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="luxury-detail-content">
                                <h4>مدة الموعد</h4>
                                <p>30 دقيقة لكل مريض</p>
                            </div>
                        </div>
                        <div class="luxury-detail-item">
                            <div class="luxury-detail-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="luxury-detail-content">
                                <h4>سعر الكشف</h4>
                                <p>2000 ريال يمني</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clinic Policies -->
                <div class="luxury-detail-card">
                    <div class="luxury-card-header">
                        <i class="fas fa-exclamation-circle"></i>
                        <h3>سياسة العيادة</h3>
                    </div>
                    <div class="luxury-card-body">
                        <div class="luxury-policy-item">
                            <i class="fas fa-check"></i>
                            <p>يرجى الحضور قبل الموعد بـ 15 دقيقة</p>
                        </div>
                        <div class="luxury-policy-item">
                            <i class="fas fa-check"></i>
                            <p>سيتم إلغاء الحجز في حالة التأخير أكثر من 10 دقائق</p>
                        </div>
                        <div class="luxury-policy-item">
                            <i class="fas fa-check"></i>
                            <p>لإلغاء الموعد يرجى التواصل قبل 24 ساعة</p>
                        </div>
                        <div class="luxury-policy-item">
                            <i class="fas fa-check"></i>
                            <p>يرجى إحضار الوثائق المطلوبة عند الزيارة</p>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="luxury-detail-card emergency">
                    <div class="luxury-card-header">
                        <i class="fas fa-phone-alt"></i>
                        <h3>الاتصال في الحالات الطارئة</h3>
                    </div>
                    <div class="luxury-card-body">
                        <div class="luxury-emergency-content">
                            <i class="fas fa-phone-volume"></i>
                            <div>
                                <h4>رقم الطوارئ</h4>
                                <a href="tel:+966112345678">+966 11 234 5678</a>
                            </div>
                        </div>
                        <p class="luxury-note">متاح 24 ساعة في حالات الطوارئ فقط</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Luxury Base Styles */
    .luxury-schedule-container {
        font-family: 'Tajawal', sans-serif;
        color: #333;
        background-color: #f9f9f9;
    }
    
    /* Luxury Header */
    .luxury-doctor-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        padding: 40px 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .luxury-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('/images/luxury-pattern.png') center/cover;
        opacity: 0.05;
    }
    
    .luxury-doctor-profile {
        display: flex;
        align-items: center;
        flex-direction: column;
        text-align: center;
    }
    
    .luxury-avatar-frame {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.3);
        padding: 5px;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    
    .luxury-doctor-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid white;
    }
    
    .luxury-verification-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: #4CAF50;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
    }
    
    .luxury-doctor-name {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .luxury-specialty {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.2rem;
        margin-bottom: 15px;
    }
    
    .luxury-rating {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .luxury-rating .stars {
        color: #FFD700;
        margin-left: 10px;
    }
    
    .luxury-rating .rating-text {
        color: white;
        font-weight: 500;
    }
    
    /* Luxury Action Bar */
    .luxury-action-bar {
        background: white;
        padding: 15px 0;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .luxury-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .luxury-btn {
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        border: none;
        cursor: pointer;
    }
    
    .luxury-primary-btn {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
    }
    .luxury-danger-btn {
        background: linear-gradient(135deg, red 0%, #3498db 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
    }
    
    .luxury-primary-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(106, 17, 203, 0.4);
    }
    
    .luxury-primary-btn i {
        margin-left: 8px;
    }
    
    .luxury-action-icons {
        display: flex;
        gap: 10px;
    }
    
    .luxury-icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 1px solid #eee;
        color: #6a11cb;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .luxury-icon-btn:hover {
        background: #f5f5f5;
        transform: translateY(-2px);
    }
    
    /* Luxury Schedule Timeline */
    .luxury-schedule-wrapper {
        padding: 40px 0;
    }
    
    .luxury-week-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .luxury-nav-btn {
        background: white;
        border: 1px solid #eee;
        padding: 10px 20px;
        border-radius: 30px;
        font-weight: 600;
        color: #555;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }
    
    .luxury-nav-btn:hover {
        background: #f9f9f9;
        color: #6a11cb;
    }
    
    .luxury-nav-btn i {
        margin: 0 5px;
    }
    
    .luxury-current-week {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
        display: flex;
        align-items: center;
    }
    
    .luxury-current-week i {
        margin-left: 8px;
    }
    
    .luxury-schedule-timeline {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }
    
    .luxury-day-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .luxury-day-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .luxury-day-card.active {
        border-top: 4px solid #4CAF50;
    }
    
    .luxury-day-card.inactive {
        border-top: 4px solid #9E9E9E;
        opacity: 0.8;
    }
    
    .luxury-day-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(to right, #f5f5f5, #fafafa);
    }
    
    .luxury-day-name h3 {
        margin: 0;
        color: #333;
        font-size: 1.3rem;
    }
    
    .luxury-day-name p {
        margin: 5px 0 0;
        color: #777;
        font-size: 0.9rem;
    }
    
    .luxury-day-status {
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    .luxury-day-status.active {
        background: rgba(76, 175, 80, 0.2);
        color: #4CAF50;
    }
    
    .luxury-day-status.inactive {
        background: rgba(158, 158, 158, 0.2);
        color: #9E9E9E;
    }
    
    .luxury-time-slots {
        padding: 20px;
    }
    
    .luxury-time-slot {
        margin-bottom: 20px;
    }
    
    .luxury-slot-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .luxury-slot-header i {
        margin-left: 10px;
        font-size: 1.2rem;
    }
    
    .luxury-slot-header h4 {
        margin: 0;
        font-size: 1rem;
        color: #555;
    }
    
    .luxury-time-slot.morning .luxury-slot-header i {
        color: #FF9800;
    }
    
    .luxury-time-slot.afternoon .luxury-slot-header i {
        color: #2196F3;
    }
    
    .luxury-slot-time {
        background: #f5f5f5;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    
    .luxury-progress-bar {
        height: 8px;
        background: #eee;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .luxury-progress-fill {
        height: 100%;
        background: linear-gradient(to right, #6a11cb, #2575fc);
    }
    
    .luxury-time-slot.morning .luxury-progress-fill {
        background: linear-gradient(to right, #FF9800, #FFC107);
    }
    
    .luxury-time-slot.afternoon .luxury-progress-fill {
        background: linear-gradient(to right, #2196F3, #03A9F4);
    }
    
    .luxury-slot-unavailable {
        background: #f9f9f9;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        color: #9E9E9E;
        font-weight: 500;
    }
    
    .luxury-slot-unavailable i {
        margin-left: 5px;
    }
    
    .luxury-day-footer {
        padding: 15px 20px;
        border-top: 1px solid #eee;
        text-align: center;
    }
    
    .luxury-book-btn {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .luxury-book-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
    }
    
    .luxury-book-btn i {
        margin-left: 8px;
    }
    
    .luxury-disabled-btn {
        background: #f5f5f5;
        color: #9E9E9E;
        border: none;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        cursor: not-allowed;
        display: inline-flex;
        align-items: center;
    }
    
    .luxury-disabled-btn i {
        margin-left: 8px;
    }
    
    /* Luxury Details Container */
    .luxury-details-container {
        padding: 40px 0;
        background: linear-gradient(to bottom, #f9f9f9, #f0f0f0);
    }
    
    .luxury-details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }
    
    .luxury-detail-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }
    
    .luxury-detail-card.emergency {
        border-top: 4px solid #F44336;
    }
    
    .luxury-card-header {
        padding: 20px;
        background: linear-gradient(to right, #f5f5f5, #fafafa);
        display: flex;
        align-items: center;
    }
    
    .luxury-card-header i {
        margin-left: 15px;
        font-size: 1.5rem;
        color: #2c3e50;
    }
    
    .luxury-card-header h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #333;
    }
    
    .luxury-detail-card.emergency .luxury-card-header i {
        color: #F44336;
    }
    
    .luxury-card-body {
        padding: 20px;
    }
    
    .luxury-detail-item {
        display: flex;
        margin-bottom: 20px;
    }
    
    .luxury-detail-icon {
        width: 40px;
        height: 40px;
        background: rgba(106, 17, 203, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
        flex-shrink: 0;
    }
    
    .luxury-detail-icon i {
        color: #2c3e50;
        font-size: 1rem;
    }
    
    .luxury-detail-content h4 {
        margin: 0 0 5px;
        font-size: 1rem;
        color: #555;
    }
    
    .luxury-detail-content p {
        margin: 0;
        color: #777;
        font-size: 0.9rem;
    }
    
    .luxury-policy-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .luxury-policy-item i {
        color: #4CAF50;
        margin-left: 10px;
        margin-top: 3px;
    }
    
    .luxury-policy-item p {
        margin: 0;
        color: #555;
    }
    
    .luxury-emergency-content {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .luxury-emergency-content i {
        font-size: 2rem;
        color: #F44336;
        margin-left: 15px;
    }
    
    .luxury-emergency-content h4 {
        margin: 0 0 5px;
        color: #555;
    }
    
    .luxury-emergency-content a {
        color: #F44336;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
    }
    
    .luxury-note {
        color: #777;
        font-size: 0.8rem;
        margin: 0;
    }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
        .luxury-doctor-name {
            font-size: 1.5rem;
        }
        
        .luxury-specialty {
            font-size: 1rem;
        }
        
        .luxury-actions {
            flex-direction: column;
            gap: 15px;
        }
        
        .luxury-week-navigation {
            flex-direction: column;
            gap: 15px;
        }
        
        .luxury-schedule-timeline {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection