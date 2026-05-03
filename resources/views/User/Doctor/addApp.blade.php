@extends('User.master')
<base href="/public">
@section('content')
<div class="luxury-appointment-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container py-5">
        <div class="luxury-card">
            <!-- Card Header -->
            <div class="luxury-card-header">
                <div class="luxury-header-content">
                    <i class="fas fa-calendar-plus luxury-icon"></i>
                    <h1 style="color: white">{{__('web.addSched')}}</h1>
                    <p> {{ $doctor->name }} -  {{ $doctor->specialization }}</p>
                </div>
                <div class="luxury-header-pattern"></div>
            </div>

            <!-- Card Body -->
            <div class="luxury-card-body">
                <form id="appointmentForm" method="POST" action="{{ route('docsche.store') }}">
                    @csrf
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                    <!-- Days Selection -->
                    <div class="luxury-section">
                        <h2 class="luxury-section-title">
                            <i class="far fa-calendar luxury-section-icon"></i>
                           {{__('web.availabeSched')}}
                            <span class="luxury-required">*</span>
                        </h2>
                        <div class="luxury-days-grid">
                            @php
                                $days = [
                                    ['ar' => 'السبت', 'en' => 'saturday', 'icon' => 'fa-calendar-day'],
                                    ['ar' => 'الأحد', 'en' => 'sunday', 'icon' => 'fa-sun'],
                                    ['ar' => 'الإثنين', 'en' => 'monday', 'icon' => 'fa-moon'],
                                    ['ar' => 'الثلاثاء', 'en' => 'tuesday', 'icon' => 'fa-star'],
                                    ['ar' => 'الأربعاء', 'en' => 'wednesday', 'icon' => 'fa-cloud-sun'],
                                    ['ar' => 'الخميس', 'en' => 'thursday', 'icon' => 'fa-calendar-check'],
                                    ['ar' => 'الجمعة', 'en' => 'friday', 'icon' => 'fa-praying-hands'],
                                ];
                            @endphp

                            @foreach($days as $index => $day)
                            <div class="luxury-day-card">
                                <input type="checkbox" id="day-{{ $index }}" 
                                       name="days[{{ $day['en'] }}]" value="{{ $day['en'] }}"
                                       class="luxury-day-checkbox" 
                                       data-day-index="{{ $index }}" 
                                       data-day-en="{{ $day['en'] }}" 
                                       data-day-ar="{{ $day['ar'] }}">
                                <label for="day-{{ $index }}" class="luxury-day-label">
                                    <i class="fas {{ $day['icon'] }} luxury-day-icon"></i>
                                    <span class="luxury-day-name">{{ $day['ar'] }}</span>
                                    
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Time Slots Container -->
                    <div id="timeSlotsContainer" class="luxury-time-slots-container"></div>

                    <!-- Form Actions -->
                    <div class="luxury-form-actions">
                        <button type="submit" class="luxury-btn luxury-primary-btn">
                            <i class="fas fa-save luxury-btn-icon"></i>
{{__('web.saveSch')}}
                        </button>
                        <a href="{{route('docsche.show',$doctor->id)}}" class="luxury-btn luxury-secondary-btn">
                            <i class="fas fa-calendar-alt luxury-btn-icon"></i>
                          {{__('web.viewYourSched')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Time Slot Template -->
<div id="timeSlotTemplate" class="luxury-time-slot-template">
    <div class="luxury-time-slot-card" data-day-en="">
        <div class="luxury-time-slot-header">
            <i class="fas fa-clock luxury-time-icon"></i>
            <h3>مواعيد يوم <span class="luxury-day-name"></span></h3>
        </div>
        <div class="luxury-time-slot-body">
            <div class="luxury-time-period">
                <h4 class="luxury-period-title">
                    <i class="fas fa-sun luxury-period-icon morning"></i>
                    الفترة الصباحية
                </h4>
                <div class="luxury-time-inputs">
                    <div class="luxury-time-input-group">
                        <input type="time" class="luxury-time-input" name="time_slots[DAY_EN][morning_start]" required>
                        <span class="luxury-time-separator">إلى</span>
                        <input type="time" class="luxury-time-input" name="time_slots[DAY_EN][morning_end]" required>
                    </div>
                </div>
            </div>
            <div class="luxury-time-period">
                <h4 class="luxury-period-title">
                    <i class="fas fa-moon luxury-period-icon afternoon"></i>
                    الفترة المسائية
                </h4>
                <div class="luxury-time-inputs">
                    <div class="luxury-time-input-group">
                        <input type="time" class="luxury-time-input" name="time_slots[DAY_EN][afternoon_start]">
                        <span class="luxury-time-separator">إلى</span>
                        <input type="time" class="luxury-time-input" name="time_slots[DAY_EN][afternoon_end]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.luxury-appointment-container {
    font-family: 'Tajawal', sans-serif;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
    padding: 40px 0;
}

/* Luxury Card */
.luxury-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.luxury-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

/* Card Header */
.luxury-card-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 30px;
    position: relative;
    overflow: hidden;
}

.luxury-header-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.luxury-header-content h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.luxury-header-content p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.luxury-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.9);
}

.luxury-header-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('/images/luxury-pattern.png') center/cover;
    opacity: 0.1;
    z-index: 1;
}

/* Card Body */
.luxury-card-body {
    padding: 30px;
}

/* Sections */
.luxury-section {
    margin-bottom: 40px;
}

.luxury-section-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    position: relative;
    padding-bottom: 10px;
}

.luxury-section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(to right, #6a11cb, #2575fc);
}

.luxury-section-icon {
    margin-left: 10px;
    color: #2c3e50;
}

.luxury-required {
    color: #e74c3c;
    margin-right: 5px;
}

/* Days Grid */
.luxury-days-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 15px;
}

.luxury-day-card {
    position: relative;
}

.luxury-day-checkbox {
    position: absolute;
    opacity: 0;
}

.luxury-day-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 10px;
    background: white;
    border-radius: 12px;
    border: 2px solid #e0e0e0;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    height: 100%;
}

.luxury-day-checkbox:checked + .luxury-day-label {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    border-color: #6a11cb;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(106, 17, 203, 0.2);
}

.luxury-day-checkbox:checked + .luxury-day-label .luxury-day-icon {
    color: white;
}

.luxury-day-icon {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #2c3e50;
    transition: all 0.3s ease;
}

.luxury-day-name {
    font-weight: 600;
    font-size: 1rem;
}

/* Time Slots Container */
.luxury-time-slots-container {
    margin-top: 30px;
}

.luxury-time-slot-template {
    display: none;
}

.luxury-time-slot-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    border-left: 4px solid #6a11cb;
}

.luxury-time-slot-header {
    background: #f8f9fa;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #eee;
}

.luxury-time-icon {
    margin-left: 10px;
    color: #6a11cb;
    font-size: 1.2rem;
}

.luxury-time-slot-header h3 {
    margin: 0;
    font-size: 1.2rem;
    color: #2c3e50;
}

.luxury-time-slot-body {
    padding: 20px;
}

.luxury-time-period {
    margin-bottom: 20px;
}

.luxury-time-period:last-child {
    margin-bottom: 0;
}

.luxury-period-title {
    font-size: 1rem;
    color: #555;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.luxury-period-icon {
    margin-left: 10px;
    font-size: 1.1rem;
}

.luxury-period-icon.morning {
    color: #f39c12;
}

.luxury-period-icon.afternoon {
    color: #3498db;
}

.luxury-time-inputs {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.luxury-time-input-group {
    display: flex;
    align-items: center;
    flex-grow: 1;
}

.luxury-time-input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    min-width: 120px;
}

.luxury-time-input:focus {
    border-color: #6a11cb;
    box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
    outline: none;
}

.luxury-time-separator {
    margin: 0 10px;
    color: #777;
}

/* Buttons */
.luxury-form-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.luxury-btn {
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    border: none;
    cursor: pointer;
    min-width: 200px;
    justify-content: center;
}

.luxury-primary-btn {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
}

.luxury-primary-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(106, 17, 203, 0.4);
}

.luxury-secondary-btn {
    background: white;
    color: #2c3e50;
    border: 2px solid #2c3e50;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.luxury-secondary-btn:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.luxury-btn-icon {
    margin-right: 8px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .luxury-days-grid {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    }
    
    .luxury-card-header {
        padding: 20px;
    }
    
    .luxury-card-body {
        padding: 20px;
    }
    
    .luxury-section-title {
        font-size: 1.3rem;
    }
    
    .luxury-form-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .luxury-btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .luxury-days-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .luxury-time-input-group {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .luxury-time-separator {
        margin: 10px 0;
        align-self: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const timeSlotsContainer = document.getElementById('timeSlotsContainer');
    const template = document.getElementById('timeSlotTemplate');

    document.querySelectorAll('.luxury-day-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const dayEn = this.dataset.dayEn;
            const dayAr = this.dataset.dayAr;

            if (this.checked) {
                addTimeSlot(dayEn, dayAr);
            } else {
                removeTimeSlot(dayEn);
            }
        });
    });

    function addTimeSlot(dayEn, dayAr) {
        if (document.querySelector(`.luxury-time-slot-card[data-day-en="${dayEn}"]`)) return;

        const clone = template.cloneNode(true);
        clone.classList.remove('luxury-time-slot-template');
        const slotCard = clone.querySelector('.luxury-time-slot-card');
        slotCard.setAttribute('data-day-en', dayEn);
        slotCard.querySelector('.luxury-day-name').textContent = dayAr;

        // استبدل DAY_EN باسم اليوم
        clone.innerHTML = clone.innerHTML.replace(/DAY_EN/g, dayEn);

        timeSlotsContainer.appendChild(clone);
    }

    function removeTimeSlot(dayEn) {
        const el = document.querySelector(`.luxury-time-slot-card[data-day-en="${dayEn}"]`);
        if (el) el.remove();
    }

    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        const checkedDays = document.querySelectorAll('.luxury-day-checkbox:checked');
        if (checkedDays.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: 'الرجاء اختيار يوم واحد على الأقل',
                confirmButtonText: 'حسناً'
            });
            return;
        }

        let hasMorning = false;
        checkedDays.forEach(day => {
            const dayEn = day.dataset.dayEn;
            const input = document.querySelector(`[name="time_slots[${dayEn}][morning_start]"]`);
            if (input && input.value) hasMorning = true;
        });

        if (!hasMorning) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: 'الرجاء إدخال الفترة الصباحية لكل يوم مختار',
                confirmButtonText: 'حسناً'
            });
        }
    });
});
</script>
@endsection
{{-- @extends('User.master')
<base href="/public">
@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary bg-gradient text-white text-center fs-4 rounded-top-4">
            <i class="fas fa-calendar-plus me-2"></i> جدولة المواعيد الطبية
        </div>
        <div class="card-body">

            <form id="appointmentForm" method="POST" action="{{ route('docsche.store') }}">
                @csrf
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                <!-- اختيار أيام العمل -->
                <div class="mb-4">
                    <label class="form-label fw-bold">حدد أيام العمل <span class="text-danger">*</span></label>
                    <div class="row g-3">
                        @php
                            $days = [
                                ['ar' => 'السبت',     'en' => 'saturday'],
                                ['ar' => 'الأحد',     'en' => 'sunday'],
                                ['ar' => 'الإثنين',   'en' => 'monday'],
                                ['ar' => 'الثلاثاء',  'en' => 'tuesday'],
                                ['ar' => 'الأربعاء',  'en' => 'wednesday'],
                                ['ar' => 'الخميس',    'en' => 'thursday'],
                                ['ar' => 'الجمعة',    'en' => 'friday'],
                            ];
                        @endphp

                        @foreach($days as $index => $day)
                        <div class="col-6 col-md-3">
                            <div class="form-check card h-100 shadow-sm border-0">
                                <input type="checkbox" id="day-{{ $index }}" 
                                       name="days[{{ $day['en'] }}]" value="{{ $day['en'] }}"
                                       class="day-checkbox form-check-input position-absolute top-0 end-0 m-2" 
                                       data-day-index="{{ $index }}" data-day-en="{{ $day['en'] }}" data-day-ar="{{ $day['ar'] }}">
                                <label for="day-{{ $index }}" class="form-check-label card-body text-center">
                                    <span class="fw-semibold">{{ $day['ar'] }}</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- الفترات الزمنية -->
                <div id="timeSlotsContainer"></div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 fs-5 rounded-pill shadow">
                        <i class="fas fa-save me-2"></i> حفظ الجدول الزمني
                    </button>
                    <a href="{{route('docsche.show',$doctor->id)}}" class="btn btn-primary px-4 py-2 fs-5 rounded-pill shadow">
                         استعرض مواعيدك
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Template للفترات الزمنية -->
<div id="timeSlotTemplate" class="d-none">
    <div class="card mb-3 shadow-sm time-slot-group" data-day-en="">
        <div class="card-header bg-light fw-bold">
            مواعيد يوم <span class="day-name text-primary"></span>
        </div>
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <label class="form-label">الفترة الصباحية</label>
                    <div class="input-group">
                        <input type="time" class="form-control" name="time_slots[DAY_EN][morning_start]" required>
                        <span class="input-group-text">إلى</span>
                        <input type="time" class="form-control" name="time_slots[DAY_EN][morning_end]" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الفترة المسائية</label>
                    <div class="input-group">
                        <input type="time" class="form-control" name="time_slots[DAY_EN][afternoon_start]">
                        <span class="input-group-text">إلى</span>
                        <input type="time" class="form-control" name="time_slots[DAY_EN][afternoon_end]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-check.card {
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid #f0f0f0;
}
.form-check.card:hover,
.day-checkbox:checked + .form-check-label {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: #fff;
    border-color: #3498db;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const timeSlotsContainer = document.getElementById('timeSlotsContainer');
    const template = document.getElementById('timeSlotTemplate');

    document.querySelectorAll('.day-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const dayEn = this.dataset.dayEn;
            const dayAr = this.dataset.dayAr;

            if (this.checked) {
                addTimeSlot(dayEn, dayAr);
            } else {
                removeTimeSlot(dayEn);
            }
        });
    });

    function addTimeSlot(dayEn, dayAr) {
        if (document.querySelector(`.time-slot-group[data-day-en="${dayEn}"]`)) return;

        const clone = template.cloneNode(true);
        clone.classList.remove('d-none');
        clone.setAttribute('data-day-en', dayEn);
        clone.querySelector('.day-name').textContent = dayAr;

        // استبدل DAY_EN باسم اليوم
        clone.innerHTML = clone.innerHTML.replace(/DAY_EN/g, dayEn);

        timeSlotsContainer.appendChild(clone);
    }

    function removeTimeSlot(dayEn) {
        const el = document.querySelector(`.time-slot-group[data-day-en="${dayEn}"]`);
        if (el) el.remove();
    }

    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        const checkedDays = document.querySelectorAll('.day-checkbox:checked');
        if (checkedDays.length === 0) {
            e.preventDefault();
            alert('الرجاء اختيار يوم واحد على الأقل');
            return;
        }

        let hasMorning = false;
        checkedDays.forEach(day => {
            const dayEn = day.dataset.dayEn;
            const input = document.querySelector(`[name="time_slots[${dayEn}][morning_start]"]`);
            if (input && input.value) hasMorning = true;
        });

        if (!hasMorning) {
            e.preventDefault();
            alert('الرجاء إدخال الفترة الصباحية لكل يوم مختار');
        }
    });
});
</script>
@stop --}}
