@extends('User.master')
<base href="/public">
@section('content')
<div class="test-container"  dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="test-card">
        <!-- Header Section -->
        <div class="test-header">
            <div class="header-icon">
                <i class="fas fa-flask"></i>
            </div>
            <h2>{{ __('web.addTest') }}</h2>
            <p>{{ __('web.addTestDescription') }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Test Form -->
        <form action="{{ route('test.store') }}" method="POST" class="test-form">
            @csrf

            <div class="form-row">
                <!-- Patient Information -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-user-injured"></i>
                        <h3>{{ __('web.patientInfo') }}</h3>
                    </div>

                    <div class="form-group">
                        <label for="patient_id" class="form-label">
                            <i class="fas fa-id-card"></i> {{ __('web.patientID') }}
                        </label>
                        <input type="text" name="patient_id" class="form-input" value="{{$patient->identity_number}}" readonly>
                    </div>
                </div>

                <!-- Doctor Information -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-user-md"></i>
                        <h3>{{ __('web.doctorInfo') }}</h3>
                    </div>

                    <div class="form-group">
                        <label for="doctor_id" class="form-label">
                            <i class="fas fa-stethoscope"></i> {{ __('web.doctor ') }}  <span class="required">*</span>
                        </label>
                        <select name="doctor_id" class="form-input" required>
                            <option value="" disabled selected> ----{{__('web.doctor_name')}}----</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <!-- Test Details -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-vial"></i>
                        <h3>{{ __('web.testDetails') }}</h3>
                    </div>

                    <div class="form-group">
                        <label for="test_type" class="form-label">
                            <i class="fas fa-dna"></i> {{ __('web.testType') }} <span class="required">*</span>
                        </label>
                        <input type="text" name="test_type" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="test_date" class="form-label">
                            <i class="fas fa-calendar-day"></i> {{ __('web.testDate') }} <span class="required">*</span>
                        </label>
                        <input type="date" name="test_date" class="form-input" required>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-chart-line"></i>
                        <h3>{{ __('web.results') }}</h3>
                    </div>

                    <div class="form-group">
                        <label for="result_value" class="form-label">
                            <i class="fas fa-hashtag"></i> {{ __('web.resultValue') }} <span class="required">*</span>
                        </label>
                        <input type="text" name="result_value" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="unit" class="form-label">
                            <i class="fas fa-ruler"></i> {{ __('web.unit') }}
                        </label>
                        <input type="text" name="unit" class="form-input">
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="form-group full-width">
                <label for="notes" class="form-label">
                    <i class="fas fa-notes-medical"></i> {{ __('web.notes') }}
                </label>
                <textarea name="notes" class="form-textarea" rows="4"></textarea>
            </div>

            <!-- Form Footer -->
            <div class="form-footer">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> {{ __('web.Save') }}
                </button>
                {{-- <a href="{{ url()->previous() }}" class="cancel-btn"> --}}
                    <a href="{{route('test.index')}}" class="cancel-btn">

                    <i class="fas fa-times"></i> {{ __('web.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Base Styles */
.test-container {
    font-family: 'Tajawal', sans-serif;
    background: #f5f7fa;
    padding: 40px 20px;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.test-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(41, 72, 94, 0.1);
    overflow: hidden;
    width: 100%;
    max-width: 1000px;
    transition: all 0.3s ease;
}

/* Header Styles */
.test-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 30px;
    text-align: center;
    position: relative;
}

.test-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.header-icon {
    font-size: 50px;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.2);
}

.test-header h2 {
    font-size: 28px;
    margin-bottom: 10px;
    font-weight: 700;
}

.test-header p {
    opacity: 0.9;
    margin-bottom: 0;
    font-size: 16px;
}

/* Alert Styles */
.alert {
    padding: 15px;
    border-radius: 8px;
    margin: 20px;
    display: flex;
    align-items: center;
}

.alert-success {
    background-color: rgba(40, 167, 69, 0.1);
    border-left: 4px solid #28a745;
    color: #28a745;
}

.alert i {
    margin-left: 10px;
}

/* Form Layout */
.test-form {
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

.form-group.full-width {
    width: 100%;
    padding: 0 15px;
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

.form-input, .form-textarea, select.form-input {
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

.form-input:focus, .form-textarea:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    outline: none;
    background: white;
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
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

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(41, 72, 94, 0.3);
}

.submit-btn i {
    margin-right: 10px;
}

.cancel-btn {
    background: white;
    color: #e74c3c;
    border: 1px solid #e74c3c;
    padding: 14px 30px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin-right: 15px;
    display: inline-flex;
    align-items: center;
}

.cancel-btn:hover {
    background: #e74c3c;
    color: white;
}

.cancel-btn i {
    margin-right: 8px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .test-form {
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
    
    .test-header {
        padding: 25px 20px;
    }
    
    .submit-btn, .cancel-btn {
        width: 100%;
        margin-bottom: 15px;
    }
}

@media (max-width: 576px) {
    .test-container {
        padding: 20px 15px;
    }
    
    .test-header h2 {
        font-size: 24px;
    }
    
    .section-header h3 {
        font-size: 18px;
    }
    
    .header-icon {
        font-size: 40px;
    }
    
    .submit-btn, .cancel-btn {
        padding: 12px 20px;
        font-size: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="test_date"]').min = today;
});
</script>

@endsection