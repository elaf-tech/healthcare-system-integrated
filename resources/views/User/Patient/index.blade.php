@extends('User.master')
<base href="/public">

@section('content')
<div class="patient-details-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="patient-details-card">
        @if(isset($patient))
            <!-- Patient Header -->
            <div class="patient-header">
                <div class="header-content">
                    <h2><i class="fas fa-user-injured"></i> {{__('web.DoctDetails')}}</h2>
                    <p>{{__('web.DoctDetDetails')}}</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('patients.edit', $patient->id) }}" class="edit-btn">
                        <i class="fas fa-edit"></i> {{__('web.Edit')}}
                    </a>
                </div>
            </div>
<!-- في ملف master.blade.php أو أي ملف تخطيط رئيسي -->
@php
$appointmesCount = \App\Models\Appointment::where('status', '=', 'confirmed')
    ->where('patient_id', auth()->id())
    // ->where('user_id', $doctor->id) // هنا نربط الموعد بالدكتور المطلوب
    ->count();
@endphp

@if ($appointmesCount > 0)
<div class="appointments-badge-wrapper">
    <div class="appointments-badge-container">
        <div class="appointments-badge">
            <i class="fas fa-calendar-check"></i>
            <span class="badge-text">لديك {{ $appointmesCount }} موعد مؤكد</span>
            <div class="pulse-effect"></div>
            <div class="confetti"></div>
        </div>
    </div>
</div>

<style>
/* التصميم المعدل للمنتصف */
.appointments-badge-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 20px 0;
    position: relative;
}

.appointments-badge-container {
    position: relative;
    display: inline-block;
    margin: 0 auto;
    text-align: center;
}

.appointments-badge {
    position: relative;
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    font-size: 1rem;
    font-weight: 500;
    box-shadow: 0 4px 20px rgba(231, 76, 60, 0.4);
    animation: bounce 2s infinite, float 6s ease-in-out infinite;
    z-index: 1;
    overflow: hidden;
    transition: all 0.3s ease;
}

.appointments-badge::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        to bottom right,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,0) 45%,
        rgba(255,255,255,0.3) 48%,
        rgba(255,255,255,0) 50%,
        rgba(255,255,255,0) 100%
    );
    transform: rotate(30deg);
    animation: shine 3s infinite;
}

.appointments-badge i {
    margin-left: 10px;
    font-size: 1.2rem;
}

.badge-text {
    position: relative;
}

.pulse-effect {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: inherit;
    border-radius: inherit;
    opacity: 0;
    z-index: -1;
    animation: pulse 2s infinite;
}

.confetti {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath fill-rule='evenodd' d='M0 0h4v4H0V0zm4 4h4v4H4V4z'/%3E%3C/g%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0;
    animation: confetti 4s ease-in-out infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(-2deg); }
    50% { transform: translateY(-10px) rotate(2deg); }
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 0.7; }
    70% { transform: scale(1.4); opacity: 0; }
    100% { opacity: 0; }
}

@keyframes shine {
    0% { transform: rotate(30deg) translate(-30%, -30%); }
    100% { transform: rotate(30deg) translate(30%, 30%); }
}

@keyframes confetti {
    0% { opacity: 0; transform: scale(0.8); }
    20% { opacity: 0.5; }
    40% { opacity: 0; transform: scale(1.2); }
    100% { opacity: 0; }
}

/* تأثيرات عند المرور */
.appointments-badge:hover {
    transform: scale(1.05) translateY(-5px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.5);
    animation-play-state: paused;
}

/* تصميم متجاوب */
@media (max-width: 768px) {
    .appointments-badge {
        font-size: 0.9rem;
        padding: 10px 20px;
    }
    
    .appointments-badge i {
        font-size: 1.1rem;
    }
}
</style>
@endif
<li class="nav-item" style="display: flex; justify-content: center; margin: 20px 0;">
    <a class="my-appointments-btn" href="{{ route('appointment.index') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>{{__('web.myAppointments')}}</span>
    </a>
</li>

{{-- <li class="nav-item" style="display: flex; justify-content: center; margin: 20px 0;">
    <a class="my-appointments-btn" href="{{ route('test.show',$patient->identity_number) }}">
        <i class="fas fa-calendar-alt"></i>
        <span>{{__('web.myAppointments')}}</span>
    </a>
</li> --}}
            <!-- Patient Details -->
            <div class="patient-details-grid">
                <!-- Personal Info Section -->
                <div class="details-section">
                    <div class="section-header">
                        <i class="fas fa-id-card"></i>
                        <h3> {{__('web.personalInfo')}}</h3>
                    </div>
                    <div class="details-row">
                        <span class="detail-label"> {{__('web.fullName')}}</span>
                        <span class="detail-value">{{ $patient->full_name }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label"> {{__('web.dateOfBirth')}}</span>
                        <span class="detail-value">{{ $patient->date_of_birth }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">{{__('web.gender')}}</span>
                        <span class="detail-value">{{ __('web.' . strtolower($patient->gender)) }}</span>                    </div>
                </div>

                <!-- Contact Info Section -->
                <div class="details-section">
                    <div class="section-header">
                        <i class="fas fa-address-book"></i>
                        <h3> {{__('web.contactInfo')}}</h3>
                    </div>
                    {{-- <div class="details-row">
                        <span class="detail-label">{{__('web.identityNumber')}} </span>
                        <span class="detail-value">{{ $patient->identity_number }}</span>
                    </div> --}}
                    <div class="details-row">
                        <span class="detail-label">{{__('web.phoneNumber')}} </span>
                        <span class="detail-value">{{ $patient->phone_number }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label"> {{__('web.email')}}</span>
                        <span class="detail-value">{{ $patient->email }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label"> {{__('web.address')}}</span>
                        <span class="detail-value">{{ $patient->address }}</span>
                    </div>
                </div>

                <!-- Medical Info Section -->
                <div class="details-section">
                    <div class="section-header">
                        <i class="fas fa-file-medical"></i>
                        <h3> {{__('web.medicalInfo')}}</h3>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">{{__('web.chronicDiseases')}} </span>
                        <span class="detail-value">{{ $patient->chronic_diseases ?: 'لا يوجد' }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label"> {{__('web.currentMedications')}}</span>
                        <span class="detail-value">{{ $patient->current_medications ?: 'لا يوجد' }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">{{__('web.allergies')}}</span>
                        <span class="detail-value">{{ $patient->allergies ?: 'لا يوجد' }}</span>
                    </div>
                </div>

                <!-- Physical Info Section -->
                <div class="details-section">
                    <div class="section-header">
                        <i class="fas fa-weight"></i>
                        <h3> {{__('web.physicalmeasurements')}}</h3>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">{{__('web.weight')}}</span>
                        <span class="detail-value">{{ $patient->weight ? $patient->weight . ' ' . __('web.kg') : __('web.unspecified') }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">{{__('web.height')}}</span>
                        <span class="detail-value">{{ $patient->height ? $patient->height . ' ' . __('web.cm') : __('web.unspecified') }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">  {{__('web.bmi')}}</span>
                        <span class="detail-value">
                            @if($patient->weight && $patient->height)
                                @php
                                    $bmi = $patient->weight / (($patient->height/100) * ($patient->height/100));
                                    $bmi = number_format($bmi, 1);
                                @endphp
                                {{ $bmi }} - 
                                @if($bmi < 18.5)
                                    <span style="color: #3498db;"> {{__('web.underweight')}} </span>
                                @elseif($bmi >= 18.5 && $bmi < 25)
                                    <span style="color: #2ecc71;"> {{__('web.normalWeight')}}</span>
                                @elseif($bmi >= 25 && $bmi < 30)
                                    <span style="color: #f39c12;"> {{__('web.overweight')}} </span>
                                @else
                                    <span style="color: #e74c3c;">{{__('web.obesity')}}</span>
                                @endif
                            @else
                                {{__('web.notCalculated')}}
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                {{-- <a href="{{ route('patients.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> رجوع
                </a>
                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد من حذف هذا المريض؟')">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                </form> --}}
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-user-slash"></i>
                </div>
                <h3>{{__('web.noData')}}</h3>
                <p>
{{__('web.dataNotFound')}}
                </p>
                <a href="{{ route('patients.create') }}" class="add-btn">
                    <i class="fas fa-user-plus"></i> {{__('web.addYourInfo')}}
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .my-appointments-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 15px 30px;
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(74, 108, 247, 0.4);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    min-width: 200px;
    gap: 10px;
}

.my-appointments-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(74, 108, 247, 0.6);
    color: white;
}

.my-appointments-btn:active {
    transform: translateY(1px);
}

.my-appointments-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: 0.5s;
}

.my-appointments-btn:hover::before {
    left: 100%;
}

.my-appointments-btn i {
    font-size: 20px;
    transition: all 0.3s;
}

.my-appointments-btn:hover i {
    transform: rotate(10deg);
}

/* تأثير النبض للفت الانتباه */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.my-appointments-btn.pulse {
    animation: pulse 2s infinite;
}
/* Base Styles */
.patient-details-container {
    font-family: 'Tajawal', sans-serif;
    background: #f5f7fa;
    padding: 30px;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.patient-details-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(41, 72, 94, 0.1);
    overflow: hidden;
    width: 100%;
    max-width: 1200px;
    transition: all 0.3s ease;
}

.patient-details-card:hover {
    box-shadow: 0 15px 35px rgba(41, 72, 94, 0.15);
}

/* Patient Header */
.patient-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.patient-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    transform: rotate(30deg);
}

.header-content h2 {
    font-size: 28px;
    margin-bottom: 5px;
    font-weight: 700;
    position: relative;
}

.header-content p {
    opacity: 0.9;
    margin-bottom: 0;
    font-size: 16px;
    position: relative;
}

.header-content i {
    margin-left: 10px;
}

.edit-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.edit-btn i {
    margin-left: 8px;
}

.edit-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

/* Patient Details Grid */
.patient-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    padding: 30px;
}

.details-section {
    background: #f8fafc;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #eaeff5;
    position: relative;
}

.section-header::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 70px;
    height: 2px;
    background: linear-gradient(90deg, #3498db, #2c3e50);
}

.section-header h3 {
    font-size: 18px;
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.section-header i {
    margin-left: 10px;
    color: #3498db;
    font-size: 20px;
}

.details-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px dashed #e2e8f0;
}

.details-row:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #4a5568;
    font-size: 15px;
}

.detail-value {
    color: #2d3748;
    text-align: left;
    max-width: 60%;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: space-between;
    padding: 20px 30px;
    border-top: 1px solid #eaeff5;
}

.back-btn {
    background: #f8fafc;
    color: #4a5568;
    border: 1px solid #e2e8f0;
    padding: 10px 25px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.back-btn i {
    margin-right: 8px;
}

.back-btn:hover {
    background: #edf2f7;
    transform: translateY(-2px);
}

.delete-btn {
    background: #fff5f5;
    color: #e53e3e;
    border: 1px solid #fed7d7;
    padding: 10px 25px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
}

.delete-btn i {
    margin-right: 8px;
}

.delete-btn:hover {
    background: #fee2e2;
    transform: translateY(-2px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 50px 30px;
}

.empty-icon {
    font-size: 60px;
    color: #cbd5e0;
    margin-bottom: 20px;
}

.empty-state h3 {
    font-size: 22px;
    color: #2c3e50;
    margin-bottom: 10px;
}

.empty-state p {
    color: #718096;
    margin-bottom: 25px;
}

.add-btn {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(41, 72, 94, 0.2);
}

.add-btn i {
    margin-right: 10px;
}

.add-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(41, 72, 94, 0.3);
}

/* Responsive Design */
@media (max-width: 992px) {
    .patient-details-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .patient-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .header-actions {
        margin-top: 15px;
        width: 100%;
    }
    
    .edit-btn {
        width: 100%;
        justify-content: center;
    }
    
    .patient-details-grid {
        grid-template-columns: 1fr;
        padding: 20px;
    }
    
    .action-buttons {
        flex-direction: column-reverse;
        gap: 15px;
    }
    
    .back-btn, .delete-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .patient-details-container {
        padding: 15px;
    }
    
    .header-content h2 {
        font-size: 24px;
    }
    
    .empty-icon {
        font-size: 50px;
    }
    
    .empty-state h3 {
        font-size: 20px;
    }
}
</style>
@endsection