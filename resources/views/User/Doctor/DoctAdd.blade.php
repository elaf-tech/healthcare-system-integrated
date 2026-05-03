@extends('User.master')
<base href="/public">
@section('content')

<div class="doctor-form-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card">
                    <!-- Form Header -->
                    <div class="form-header">
                        <h2 class="form-title">
                            <i class="fas fa-user-md me-2"></i>
                            {{ __('web.AddNewDoctor') }}
                        </h2>
                        <div class="header-decoration"></div>
                    </div>
                    
                    <!-- Doctor Form -->
                    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Doctor Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>
                                        {{ __('web.DoctorName') }}
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">
                                        {{ __('web.PleaseProvideDoctorName') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>
                                        {{ __('web.Email') }}
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">
                                        {{ __('web.PleaseProvideEmail') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>
                                        {{ __('web.Password') }}
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">
                                        {{ __('web.PleaseProvidePassword') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-phone me-2"></i>
                                        {{ __('web.Phone') }}
                                    </label>
                                    <input type="number" class="form-control" id="phone" name="phone" required>
                                    <div class="invalid-feedback">
                                        {{ __('web.PleaseProvidePhone') }}
                                    </div>
                                </div>
                            </div>
                            <!-- Specialization -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="specialization" class="form-label">
                                        <i class="fas fa-stethoscope me-2"></i>
                                        {{ __('web.Specialization') }}
                                    </label>
                                    <select class="form-select" id="specialization" name="specialization" required>
                                        <option value="" selected disabled>{{ __('web.SelectSpecialization') }}</option>
                                        <option value="General">{{ __('web.General') }}</option>
                                        <option value="Cardiology">{{ __('web.Cardiology') }}</option>
                                        <option value="Neurology">{{ __('web.Neurology') }}</option>
                                        <option value="Pediatrics">{{ __('web.Pediatrics') }}</option>
                                        <option value="Orthopedics">{{ __('web.Orthopedics') }}</option>
                                        <option value="Dermatology">{{ __('web.Dermatology') }}</option>
                                        <option value="Pulmonology">{{ __('web.Pulmonology') }}</option>
                                        <option value="Psychiatry">{{ __('web.Psychiatry') }}</option>
                                        <option value="EmergencyMedicine">{{ __('web.EmergencyMedicine') }}</option>
                                        <option value="Radiology">{{ __('web.Radiology') }}</option>
                                        <option value="ForensicMedicine">{{ __('web.ForensicMedicine') }}</option>
                                        <option value="Dentistry">{{ __('web.Dentistry') }}</option>
                                        <option value="Ophthalmology">{{ __('web.Ophthalmology') }}</option>
                                        <option value="ENT">{{ __('web.ENT') }}</option>
                                        <option value="Oncology">{{ __('web.Oncology') }}</option>
                                        <option value="Urology">{{ __('web.Urology') }}</option>
                                        <option value="Geriatrics">{{ __('web.Geriatrics') }}</option>
                                        <option value="Anesthesiology">{{ __('web.Anesthesiology') }}</option>
                                        <option value="Pathology">{{ __('web.Pathology') }}</option>
                                        <option value="PrimaryCare">{{ __('web.PrimaryCare') }}</option>
                                        <option value="RehabilitationMedicine">{{ __('web.RehabilitationMedicine') }}</option>
                                        <option value="Nutrition">{{ __('web.Nutrition') }}</option>
                                        <option value="InfectiousDiseases">{{ __('web.InfectiousDiseases') }}</option>
                                        <option value="SportsMedicine">{{ __('web.SportsMedicine') }}</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('web.PleaseSelectSpecialization') }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hospital Selection -->
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hospital_id" class="form-label">
                                        <i class="fas fa-hospital me-2"></i>
                                        {{ __('web.Hospital') }}
                                    </label>
                                  
                                    <select class="form-select" id="hospital_id" name="hospital_id" required>
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        <option value="" disabled>{{ __('web.SelectHospital') }}</option>
                                        @foreach($hospitals as $hospitalItem)
                                            <option value="{{ $hospitalItem->id }}">{{ $hospitalItem->name }}</option>
                                        @endforeach
                                    </select>
                                 

                                    <div class="invalid-feedback">
                                        {{ __('web.PleaseSelectHospital') }}
                                    </div>
                                </div>
                            </div> --}}
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">
                                        <i class="fas fa-camera me-2"></i>
                                        {{ __('web.DoctorImage') }}
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                    <div class="file-upload-preview mt-2">
                                        <img id="imagePreview" src="#" alt="Preview" class="d-none" style="max-width: 100%; height: auto; border-radius: 8px;">
                                        <div class="upload-placeholder">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span>{{ __('web.ChooseImage') }}</span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __('web.PleaseUploadDoctorImage') }}
                                    </div>
                                </div>
                            </div>
                                                
                            <!-- Submit Button -->
                            <div class="col-12">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fas fa-plus-circle me-2"></i>
                                        {{ __('web.Save') }}
                                    </button>
                                    <a href="{{ route('doctors.index') }}" class="btn btn-cancel">
                                        <i class="fas fa-times me-2"></i>
                                        {{ __('web.Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Font Imports */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

/* Base Styles */
.doctor-form-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
    min-height: 100vh;
    padding: 60px 0;
    font-family: 'Poppins', sans-serif;
}

/* Form Card */
.form-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.form-card:hover {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    transform: translateY(-5px);
}

/* Form Header */
.form-header {
    padding: 25px 30px;
    background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
    color: white;
    position: relative;
}

.form-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
}

.header-decoration {
    position: absolute;
    bottom: -15px;
    left: 0;
    width: 100%;
    height: 30px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%23fff'%3E%3C/path%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%23fff'%3E%3C/path%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%23fff'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
}

/* Form Body */
form {
    padding: 30px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.form-label i {
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;
    color: #3498db;
}

.form-control, .form-select {
    border: 1px solid #e0e6ed;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s;
}

.form-control:focus, .form-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

/* File Upload */
.file-upload-wrapper {
    position: relative;
}

.file-upload-preview {
    border: 2px dashed #e0e6ed;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 5px;
    position: relative;
    overflow: hidden;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.file-upload-preview:hover {
    border-color: #3498db;
    background: rgba(52, 152, 219, 0.05);
}

.upload-placeholder {
    color: #7f8c8d;
    transition: all 0.3s;
}

.upload-placeholder i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
    color: #3498db;
}

.upload-placeholder span {
    display: block;
    font-size: 0.9rem;
}

#imagePreview {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    display: none;
}

input[type="file"] {
    position: absolute;
    left: -9999px;
    opacity: 0;
}

/* Buttons */
.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.btn-submit {
    background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
    color: white;
}

.btn-cancel {
    background: white;
    color: #e74c3c;
    border: 1px solid #e74c3c;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
    display: flex;
    align-items: center;
}

.btn-cancel:hover {
    background: #e74c3c;
    color: white;
}

/* Validation */
.invalid-feedback {
    color: #e74c3c;
    font-size: 0.85rem;
    margin-top: 5px;
}

.was-validated .form-control:invalid,
.was-validated .form-select:invalid,
.was-validated .file-upload-preview:invalid {
    border-color: #e74c3c;
}

.was-validated .form-control:invalid:focus,
.was-validated .form-select:invalid:focus {
    box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
}

/* Responsive */
@media (max-width: 767.98px) {
    .form-title {
        font-size: 1.5rem;
    }
    
    .form-header {
        padding: 20px;
    }
    
    form {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-submit, .btn-cancel {
        width: 100%;
        justify-content: center;
    }
}

/* RTL Adjustments */
[dir="rtl"] .form-label i {
    margin-right: 8px;
    margin-left: 0;
}

[dir="rtl"] .btn-submit i,
[dir="rtl"] .btn-cancel i {
    margin-right: 8px;
    margin-left: 0;
}

.file-upload-preview {
    border: 2px dashed #e0e6ed;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 5px;
    height: auto; /* تغيير الارتفاع ليكون تلقائي */
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-placeholder {
    color: #7f8c8d;
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.upload-placeholder i {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #3498db;
}

#imagePreview {
    max-width: 100%;
    max-height: 150px; /* تحديد ارتفاع أقصى للصورة */
    object-fit: cover; /* الحفاظ على نسبة العرض إلى الارتفاع */
    border-radius: 8px;
    display: block; /* جعل الصورة كتلة لملء الحاوية */
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPlaceholder = document.querySelector('.upload-placeholder');
        const fileUploadPreview = document.querySelector('.file-upload-preview');
    
        // لما تضغط على preview يفتح اختيار الصورة
        fileUploadPreview.addEventListener('click', function() {
            imageInput.click();
        });
    
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
    
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                    uploadPlaceholder.classList.add('d-none');
                }
    
                reader.readAsDataURL(file);
            }
        });
    });
    </script>
{{--     
<script>document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.querySelector('.upload-placeholder');
    
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
                uploadPlaceholder.classList.add('d-none');
            }
            
            reader.readAsDataURL(file);
        }
    }); --}}
{{-- });// --}}
{{-- </script> --}}
@endsection