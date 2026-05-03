@extends('User.master')
<base href="/public">

@section('content')
<div class="doctors-page" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title animate__animated animate__fadeInDown">{{ __('web.availableDoctors') }}</h1>
                <p class="hero-subtitle animate__animated animate__fadeInDown animate__delay-1s">{{ __('web.availableDoctorsDet') }}</p>
                <div>
                    {{-- @if(Auth::check())
                        <a href="{{ route('doctors.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle me-2"></i> {{ __('web.addDoctor') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle me-2"></i> {{ __('web.addDoctor') }}
                        </a>
                    @endif
                    <a href="#doctors" class="btn btn-outline-light btn-lg ms-3 scroll-down">
                        <i class="fas fa-arrow-down me-2"></i> {{ __('web.explore') }}
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Doctors Grid -->
    <div class="container py-5" id="doctors">
        <div class="row g-4">
            @foreach($doctors as $doctor)
            <div class="col-lg-4 col-md-6 doctor-item">
                <div class="doctor-card">
                    <div class="doctor-image">
                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" loading="lazy">
                        <div class="doctor-badge">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="doctor-overlay"></div>
                    </div>
                    <div class="doctor-content">
                        <h3>{{ $doctor->name }}</h3>
                        <p class="text-muted mb-1"><i class="fas fa-stethoscope me-1"></i> {{ $doctor->specialization }}</p>
                        <p class="small"><i class="fas fa-hospital me-1"></i> {{ $doctor->hospital->name ?? '' }}</p>
                        <div class="doctor-actions mt-3">
                            <!-- عرض معلومات الطبيب -->
                            
                            <a href="{{route('docsche.create',$doctor->id)}}" class="btn btn-action " {{ $doctor->email !== $currentUserEmail ? 'hidden' : '' }}>
                                <i class="fas fa-calendar-alt"></i>    حدد مواعيدك
                            </a>
                            {{-- <a href="#" class="btn btn-action btn-sm">
                                <i class="fas fa-eye"></i> <span>{{ __('web.viewProfile') }}</span>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
/* Hero section copy-paste + تعديل بسيط */
.hero-section {
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                url('https://images.unsplash.com/photo-1588776814546-6cbbea9b927f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: white;
    padding: 8rem 0 10rem;
    position: relative;
}

.hero-overlay {
    position: absolute;
    top:0; left:0; width:100%; height:100%;
    background: linear-gradient(135deg, rgba(52,152,219,0.8), rgba(46,204,113,0.8));
    z-index: 0;
}

.hero-content {
    position: relative; z-index:1; text-align:center; max-width:800px; margin:auto;
}

.hero-title {
    font-size:3rem; font-weight:900; margin-bottom:1rem; text-shadow:0 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size:1.4rem; opacity:0.9; margin-bottom:2.5rem; line-height:1.6;
}

.btn-outline-light:hover {
    background:white; color: var(--primary);
}

/* Doctor Card */
.doctor-card {
    background:#fff; border-radius:12px; overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
    transition:all 0.3s ease; height:100%;
    position:relative;
}

.doctor-card:hover {
    transform:translateY(-8px); box-shadow:0 15px 35px rgba(0,0,0,0.15);
}

.doctor-image {
    position:relative; height:220px; overflow:hidden;
}

.doctor-image img {
    width:100%; height:100%; object-fit:cover;
    transition:transform 0.6s ease;
}

.doctor-card:hover .doctor-image img {
    transform:scale(1.08);
}

.doctor-overlay {
    position:absolute; top:0; left:0; width:100%; height:100%;
    background:linear-gradient(to top, rgba(0,0,0,0.6), transparent);
    opacity:0; transition:0.3s;
}

.doctor-card:hover .doctor-overlay {
    opacity:1;
}

.doctor-badge {
    position:absolute; top:15px; left:15px;
    background:rgba(0,0,0,0.7); color:white; padding:5px 12px;
    border-radius:20px; font-size:0.8rem; z-index:2;
}

.doctor-content {
    padding:1.5rem; text-align:center;
}

.doctor-content h3 {
    font-size:1.3rem; font-weight:700; color:var(--dark); margin-bottom:0.5rem;
}

.doctor-actions .btn-action {
    background:linear-gradient(135deg, var(--primary), var(--secondary));
    color:white; border:none; border-radius:8px; padding:8px 15px;
    font-weight:600; font-size:0.9rem; display:inline-flex; align-items:center;
    gap:6px; transition:0.3s;
}

.doctor-actions .btn-action:hover {
    transform:translateY(-2px); box-shadow:0 5px 15px rgba(52,152,219,0.3);
    background:linear-gradient(135deg, var(--primary-dark), var(--secondary-dark));
}

/* Variables */
:root {
    --primary: #3498db;
    --primary-dark: #2980b9;
    --secondary: #2ecc71;
    --secondary-dark: #27ae60;
    --dark: #2c3e50;
}

/* Responsive */
@media(max-width:768px){
    .hero-title{font-size:2.2rem;}
    .doctor-image{height:200px;}
}
</style>
@endsection
