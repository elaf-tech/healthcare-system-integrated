@extends('User.master')
<base href="/public">

@section('content')
<div class="patient-form-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="patient-form-card">
            <!-- Form Header -->
            <div class="form-header">
                <div class="header-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>  {{__('web.editPatient')}}</h2>
                <p>   {{__('web.fill_required_fields')}}</p>
            </div>

            <!-- Patient Form -->
            <form action="{{ route('patients.update',$patient->id) }}" method="POST" class="patient-form">
                @csrf
                @method('PUT') 
                <div class="form-row">
                    <!-- Personal Info Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-id-card"></i>
                            <h3>{{__('web.personalInfo')}} </h3>
                        </div>

                        <div class="form-group">
                            <label for="full_name" class="form-label">
                                <i class="fas fa-user"></i> {{__('web.fullName')}} 
                                <span class="required">*</span>
                            </label>
                            <input type="text" id="full_name" name="full_name" class="form-input" value="{{$patient->full_name}}" required>
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth" class="form-label">
                                <i class="fas fa-birthday-cake"></i> {{__('web.dateOfBirth')}} 
                                <span class="required">*</span>
                            </label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{$patient->date_of_birth}}" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="form-label">
                                <i class="fas fa-venus-mars"></i> {{__('web.gender')}}
                                <span class="required">*</span>
                            </label>
                            <select id="gender" name="gender" class="form-input" required>
                                <option value="{{$patient->gender}}">{{$patient->gender}}</option>
                                <option value="male">{{__('web.male')}}</option>
                                <option value="female">{{__('web.female')}}</option>
                                {{-- <option value="other">أخرى</option> --}}
                            </select>
                        </div>
                    </div>

                    <!-- Contact Info Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-address-book"></i>
                            <h3> {{__('web.contactInfo')}}</h3>
                        </div>

                        <div class="form-group">
                            <label for="identity_number" class="form-label">
                                <i class="fas fa-id-card-alt"></i> {{__('web.identityNumber')}} 
                                <span class="required">*</span>
                            </label>
                            <input type="text" id="identity_number" name="identity_number" value="{{$patient->identity_number}}" class="form-input" disabled>
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="form-label">
                                <i class="fas fa-phone"></i>  {{__('web.phoneNumber')}}
                                <span class="required">*</span>
                            </label>
                            <input type="text" id="phone_number" name="phone_number" value="{{$patient->phone_number}}" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> {{__('web.Email')}} 
                            </label>
                            <input type="email" id="email" name="email" value="{{$patient->email}}" class="form-input" disabled>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">
                                <i class="fas fa-map-marker-alt"></i> {{__('web.address')}} 
                            </label>
                            <input type="text" id="address" name="address" value="{{$patient->address}}" class="form-input">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Medical Info Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-file-medical"></i>
                            <h3>{{__('web.medicalInfo')}} </h3>
                        </div>

                        <div class="form-group">
                            <label for="chronic_diseases" class="form-label">
                                <i class="fas fa-disease"></i> {{__('web.chronicDiseases')}} 
                            </label>
                            <input type="text" id="chronic_diseases" name="chronic_diseases" class="form-input" value="{{$patient->chronic_diseases}}">
                        </div>

                        <div class="form-group">
                            <label for="current_medications" class="form-label">
                                <i class="fas fa-pills"></i>  {{__('web.currentMedications')}}
                            </label>
                            <input type="text" id="current_medications" name="current_medications" class="form-input" value="{{$patient->current_medications}}">
                        </div>

                        <div class="form-group">
                            <label for="allergies" class="form-label">
                                <i class="fas fa-allergies"></i> {{__('web.allergies')}}
                            </label>
                            <input type="text" id="allergies" name="allergies" class="form-input" value="{{$patient->allergies}}">
                        </div>
                    </div>

                    <!-- Physical Info Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-weight"></i>
                            <h3>{{__('web.physicalmeasurements')}} </h3>
                        </div>

                        <div class="form-group">
                            <label for="weight" class="form-label">
                                <i class="fas fa-weight-hanging"></i> {{__('web.weight')}} ({{__('web.kg')}})
                            </label>
                            <input type="number" step="0.01" id="weight" name="weight" value="{{$patient->weight}}" class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="height" class="form-label">
                                <i class="fas fa-ruler-vertical"></i> {{__('web.height')}} ({{__('web.cm')}})
                            </label>
                            <input type="number" id="height" name="height" value="{{$patient->height}}" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-calculator"></i> {{__('web.bmi')}}
                            </label>
                            <div class="bmi-display" id="bmiResult">
                                {{__('web.auto')}}
                           </div>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="form-footer">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save"></i> {{__('web.Save')}}
                    </button>
                    <a href="{{route('patients.index')}}" class="btn btn-danger">
                        <i class="fas fa-save"></i> {{__('web.Cancel')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.patient-form-container {
    font-family: 'Tajawal', sans-serif;
    background: #f5f7fa;
    padding: 40px 0;
    min-height: 100vh;
}

/* Card Styles */
.patient-form-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(41, 72, 94, 0.1);
    overflow: hidden;
    max-width: 1200px;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.patient-form-card:hover {
    box-shadow: 0 15px 35px rgba(41, 72, 94, 0.15);
}

/* Form Header */
.form-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 35px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.form-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    transform: rotate(30deg);
}

.form-header h2 {
    font-size: 28px;
    margin-bottom: 10px;
    font-weight: 700;
    position: relative;
}

.form-header p {
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
.patient-form {
    padding: 35px;
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
    margin-bottom: 22px;
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

select.form-input {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%232c3e50' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 12px;
}

/* BMI Display */
.bmi-display {
    padding: 12px 15px;
    background: #f0f4f8;
    border-radius: 8px;
    font-weight: 600;
    color: #4a5568;
    min-height: 46px;
}

/* Form Footer */
.form-footer {
    margin-top: 40px;
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
    .patient-form {
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
    
    .form-header {
        padding: 25px 20px;
    }
    
    .patient-form {
        padding: 20px;
    }
    
    .submit-btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .form-header h2 {
        font-size: 24px;
    }
    
    .section-header h3 {
        font-size: 18px;
    }
    
    .header-icon {
        font-size: 40px;
    }
}
</style>

<script>
// Calculate BMI when weight or height changes
document.addEventListener('DOMContentLoaded', function() {
    const weightInput = document.getElementById('weight');
    const heightInput = document.getElementById('height');
    const bmiResult = document.getElementById('bmiResult');
    
    function calculateBMI() {
        const weight = parseFloat(weightInput.value);
        const height = parseFloat(heightInput.value) / 100; // convert cm to m
        
        if (weight && height) {
            const bmi = (weight / (height * height)).toFixed(1);
            let category = '';
            let color = '';
            
            if (bmi < 18.5) {
                category = 'نقص في الوزن';
                color = '#3498db';
            } else if (bmi >= 18.5 && bmi < 25) {
                category = 'وزن طبيعي';
                color = '#2ecc71';
            } else if (bmi >= 25 && bmi < 30) {
                category = 'زيادة في الوزن';
                color = '#f39c12';
            } else {
                category = 'سمنة';
                color = '#e74c3c';
            }
            
            bmiResult.innerHTML = `<span style="font-size: 18px; color: ${color}">${bmi}</span> - ${category}`;
        } else {
            bmiResult.textContent = 'سيتم حسابها تلقائيًا';
        }
    }
    
    weightInput.addEventListener('input', calculateBMI);
    heightInput.addEventListener('input', calculateBMI);
});
</script>
@endsection