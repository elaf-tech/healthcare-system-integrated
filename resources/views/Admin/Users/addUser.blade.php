@extends('User.master')
<base href="/public">
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="admin-form-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card">
                    <!-- Form Header -->
                    <div class="form-header">
                        <h2 class="form-title">
                            <i class="fas fa-user-shield me-2"></i>
                            إضافة مدير جديد للنظام
                        </h2>
                        <div class="header-decoration"></div>
                    </div>
                    
                    <!-- Admin Form -->
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>
                                        الاسم الكامل
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">
                                        يرجى إدخال الاسم الكامل
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>
                                        البريد الإلكتروني
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">
                                        يرجى إدخال بريد إلكتروني صحيح
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>
                                        كلمة المرور
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">
                                        يرجى إدخال كلمة مرور قوية
                                    </div>
                                </div>
                            </div>
                            <!-- Confirm Password -->
<div class="col-md-6">
    <div class="form-group">
        <label for="password_confirmation" class="form-label">
            <i class="fas fa-lock me-2"></i>
            تأكيد كلمة المرور
        </label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        <div class="invalid-feedback">
            يرجى تأكيد كلمة المرور
        </div>
    </div>
</div>
                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-2"></i>
                                        رقم الهاتف
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                    <div class="invalid-feedback">
                                        يرجى إدخال رقم هاتف صحيح
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Specialization -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="specialization" class="form-label">
                                        <i class="fas fa-graduation-cap me-2"></i>
                                        التخصص (إن وجد)
                                    </label>
                                    <input type="text" class="form-control" id="specialization" name="specialization">
                                </div>
                            </div>
                            
                            <!-- Role -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="form-label">
                                        <i class="fas fa-user-tag me-2"></i>
                                        الصلاحية
                                    </label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="" selected disabled>اختر نوع المستخدم</option>
                                        <option value="0">مستخدم عادي </option>
                                        <option value="1">طبيب </option>
                                        {{-- <option value="2">مدير </option> --}}
                                    </select>
                                    <div class="invalid-feedback">
                                        يرجى اختيار نوع الصلاحية
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">
                                        <i class="fas fa-users-cog me-2"></i>
                                        النوع
                                    </label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="" selected disabled>اختر نوع المستخدم</option>
                                        <option value="1">إداري</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        يرجى اختيار نوع المستخدم
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Image -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">
                                        <i class="fas fa-camera me-2"></i>
                                        صورة المدير
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                    <div class="file-upload-preview mt-2">
                                        <img id="imagePreview" src="#" alt="Preview" class="d-none" style="max-width: 100%; height: auto; border-radius: 8px;">
                                        <div class="upload-placeholder">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span>اختر صورة للمدير</span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        يرجى تحميل صورة المدير
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fas fa-plus-circle me-2"></i>
                                        حفظ المدير
                                    </button>
                                    <a href="{{ route('admin.index') }}" class="btn btn-cancel">
                                        <i class="fas fa-times me-2"></i>
                                        إلغاء
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
@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

/* Base Styles */
.admin-form-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
    min-height: 100vh;
    padding: 60px 0;
    font-family: 'Tajawal', sans-serif;
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
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
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
    margin-left: 8px;
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
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.4);
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
    
    // Form validation
    (function() {
        'use strict';
        
        var forms = document.querySelectorAll('.needs-validation');
        
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    
                    form.classList.add('was-validated');
                }, false);
            });
    })();
});
</script>

@endsection