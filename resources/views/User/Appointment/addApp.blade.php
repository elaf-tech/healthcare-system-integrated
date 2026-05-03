@extends('User.master')
<base href="/public">

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('released_slot'))
    @section('scripts')
    <script>
        // إعادة تحميل الصفحة بلطف لضمان تحديث الفترات
        setTimeout(() => {
            window.location.reload();
        }, 1500);
    </script>
    @endsection
@endif
<div class="appointment-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="appointment-card">
        <!-- Appointment Header -->
        <div class="appointment-header">
            <div class="header-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h2>{{(__('web.appointment_header'))}}</h2>
            <p>{{__('web.fill_required_fields')}}</p>
        </div>

        <!-- Appointment Form -->
        <form action="{{ route('appointment.store') }}" method="POST" class="appointment-form">
            @csrf
            
            <div class="form-row">
                <!-- Patient Information -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-user-injured"></i>
                        <h3> {{__('web.patient_info')}}</h3>
                    </div>

                    <div class="form-group">
                        <label for="patient_id" class="form-label">
                            <i class="fas fa-id-card"></i> {{__('web.patient')}}
                            <span class="required">*</span>
                        </label>

                        <input type="text"  value="{{ $patient->full_name }}" class="form-input" readonly>
                        <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient->identity_number }}">                      </div>
                </div>

                <!-- Doctor Information -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-user-md"></i>
                        <h3> {{__('web.doctor_info')}}</h3>
                    </div>

                    <div class="form-group">
                        <label for="doctor_id" class="form-label">
                            <i class="fas fa-id-card-alt"></i> {{__('web.doctor_name')}}
                            <span class="required">*</span>
                        </label>

                        <input type="text"  value="{{ $doctor->name }}" class="form-input" readonly>
                        <input type="hidden" id="user_id" name="user_id" value="{{ $doctor->id }}">                    </div>
                </div>
            </div>

            <div class="form-row">
                <!-- Appointment Details -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-clock"></i>
                        <h3> {{__('web.appointment_details')}}</h3>
                    </div>
                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                    <div class="form-group">
                        <label for="day" class="form-label">
                            <i class="fas fa-day"></i>{{(__('web.appointment_day'))}}
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="day" name="day"  value="{{ $schedule->day }}" class="form-input" readonly>
                    </div>

                    <div class="form-group">
                        <label for="time" class="form-label">
                            <i class="fas fa-clock"></i> {{__('web.appointment_time')}}
                            <span class="required">*</span>
                        </label>
                        <select id="time" name="time" class="form-input" required>
                            <option value="" disabled selected>--{{__('web.appointment_time')}}-- </option>
                            
                            <!-- الفترة الصباحية -->
                            @if(count($morningSlots) > 0)
                                <optgroup label="الفترة الصباحية">
                                    @foreach ($morningSlots as $time)
                                        <option value="{{ $time }}">{{ \Carbon\Carbon::parse($time)->format('h:i A') }}</option>
                                    @endforeach
                                </optgroup>
                            @endif
                            
                            <!-- الفترة المسائية -->
                            @if(count($afternoonSlots) > 0)
                                <optgroup label="الفترة المسائية">
                                    @foreach ($afternoonSlots as $time)
                                        <option value="{{ $time }}">{{ \Carbon\Carbon::parse($time)->format('h:i A') }}</option>
                                    @endforeach
                                </optgroup>
                            @endif
                            
                            @if(count($morningSlots) == 0 && count($afternoonSlots) == 0)
                                <option disabled>لا توجد أوقات متاحة</option>
                            @endif
                        </select>
                    </div>

                <!-- Additional Information -->
                
            </div>
        </div>
            <!-- Form Footer -->
            <div class="form-footer">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-calendar-plus"></i>{{__('web.confirm_appointment')}}
                </button>
                <a href="{{route('docsche.show',$doctor->id)}}" class="btn btn-danger">
                    <i class="fas fa-times me-2"></i>
                    {{ __('web.Cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Base Styles */
.appointment-container {
    font-family: 'Tajawal', sans-serif;
    background: #f5f7fa;
    padding: 40px 20px;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.appointment-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(41, 72, 94, 0.1);
    overflow: hidden;
    width: 100%;
    max-width: 1000px;
    transition: all 0.3s ease;
}

.appointment-card:hover {
    box-shadow: 0 15px 35px rgba(41, 72, 94, 0.15);
}

/* Appointment Header */
.appointment-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.appointment-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    transform: rotate(30deg);
}

.appointment-header h2 {
    font-size: 28px;
    margin-bottom: 10px;
    font-weight: 700;
    position: relative;
}

.appointment-header p {
    opacity: 0.9;
    margin-bottom: 0;
    font-size: 16px;
    position: relative;
}

.header-icon {
    font-size: 50px;
    margin-bottom: 20px;
    color: rgba(255, 255, 255, 0.2);
    position: relative;
}

/* Form Layout */
.appointment-form {
    padding: 30px;
}

.form-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.form-section {
    flex: 1;
    min-width: 300px;
    padding: 0 15px;
    margin-bottom: 30px;
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 10px;
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
    font-size: 20px;
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.section-header i {
    margin-left: 10px;
    color: #3498db;
    font-size: 22px;
}

/* Form Elements */
.form-group {
    margin-bottom: 20px;
    position: relative;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #4a5568;
    font-size: 15px;
}

.form-label i {
    margin-left: 8px;
    color: #3498db;
    width: 20px;
    text-align: center;
}

.required {
    color: #e74c3c;
    margin-right: 5px;
}

.form-input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s;
    background: #f8fafc;
    color: #2d3748;
    font-family: 'Tajawal', sans-serif;
}

.form-input:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    outline: none;
    background: white;
}

.form-textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s;
    background: #f8fafc;
    color: #2d3748;
    font-family: 'Tajawal', sans-serif;
    resize: vertical;
    min-height: 120px;
}

.form-textarea:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    outline: none;
    background: white;
}

/* Form Footer */
.form-footer {
    margin-top: 30px;
    text-align: center;
}

.submit-btn {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 50px;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 5px 15px rgba(41, 72, 94, 0.2);
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
}

.submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: 0.5s;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(41, 72, 94, 0.3);
}

.submit-btn:hover::before {
    left: 100%;
}

.submit-btn i {
    margin-right: 10px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .appointment-form {
        padding: 25px;
    }
}

@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
    }
    
    .form-section {
        padding: 0;
    }
    
    .appointment-header {
        padding: 25px 20px;
    }
    
    .submit-btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .appointment-container {
        padding: 20px 15px;
    }
    
    .appointment-header h2 {
        font-size: 24px;
    }
    
    .section-header h3 {
        font-size: 18px;
    }
    
    .header-icon {
        font-size: 40px;
    }
    
    .submit-btn {
        padding: 12px 20px;
        font-size: 16px;
    }
}
</style>

<script>
// Date and Time Validation
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointment_date').min = today;
    
    // Prevent past dates
    document.getElementById('appointment_date').addEventListener('change', function() {
        if (this.value < today) {
            alert('لا يمكن حجز موعد في تاريخ قديم');
            this.value = today;
        }
    });
    
    // Business hours validation (example: 8AM to 5PM)
    document.getElementById('time').addEventListener('change', function() {
        const time = this.value;
        const hours = parseInt(time.split(':')[0]);
        
        if (hours < 8 || hours >= 17) {
            alert('ساعات العمل من 8 صباحاً إلى 5 مساءً');
            this.value = '';
        }
    });
});
</script>
@endsection