@extends('User.master')
<base href="/public">

@section('content')
<div class="patient-details-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="patient-details-card">
        @if(isset($test))
            <!-- Patient Header -->
            <div class="patient-header">
                <div class="header-content">
                    <h2><i class="fas fa-user-injured"></i> {{__('web.DoctDetails')}}</h2>
                    <p>{{__('web.DoctDetDetails')}}</p>
                </div>
                <div class="header-actions">
                    {{-- <a href="{{ route('patients.edit', $patient->id) }}" class="edit-btn">
                        <i class="fas fa-edit"></i> {{__('web.Edit')}}
                    </a> --}}
                </div>
            </div>
<!-- في ملف master.blade.php أو أي ملف تخطيط رئيسي -->
<li class="nav-item" style="display: flex; justify-content: center; margin: 20px 0;">
    <a class="my-appointments-btn" href="{{ route('appointment.index') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>{{__('web.myAppointments')}}</span>
    </a>
</li>
            <!-- Patient Details -->
            <div class="details-section">
                <div class="section-header">
                    <i class="fas fa-file-medical"></i>
                    <h3>{{ __('web.testResults') }}</h3>
                </div>
                
                @if($tests->isEmpty())
                    <div class="empty-state">
                        <h3>{{ __('web.noTestResults') }}</h3>
                        <p>{{ __('web.noPreviousTests') }}</p>
                    </div>
                @else
                    @foreach($tests as $test)
                        <div class="details-row">
                            <span class="detail-label">{{ __('web.testType') }}</span>
                            <span class="detail-value">{{ $test->test_type }}</span>
                        </div>
                        <div class="details-row">
                            <span class="detail-label">{{ __('web.testDate') }}</span>
                            <span class="detail-value">{{ $test->test_date }}</span>
                        </div>
                        <div class="details-row">
                            <span class="detail-label">{{ __('web.resultValue') }}</span>
                            <span class="detail-value">{{ $test->result_value }} {{ $test->unit }}</span>
                        </div>
                        <div class="details-row">
                            <span class="detail-label">{{ __('web.notes') }}</span>
                            <span class="detail-value">{{ $test->notes ?: 'لا توجد ملاحظات' }}</span>
                        </div>
                        <hr>
                    @endforeach
                @endif
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
                <a href="{{ route('test.create', ['user_id' => auth()->user()->id]) }}" class="add-btn">
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