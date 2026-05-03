<div class="container-fluid navbar-premium" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark py-2">
            <!-- Logo Section -->
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                <div class="logo-icon animate__animated animate__pulse animate__infinite">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h1 class="m-0 logo-text">
                    {{ __('web.title') }}
                </h1>
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPremium">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main Navigation -->
            <div class="collapse navbar-collapse" id="navbarPremium">
                <ul class="navbar-nav {{ app()->getLocale() == 'ar' ? 'me-auto' : 'ms-auto' }} mb-2 mb-lg-0">
                    <!-- Home Link -->
                    <li class="nav-item mx-1">
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '/') }}" class="nav-link nav-item-wrapper">
                            <div class="nav-item-content">
                                <i class="fas fa-home fa-fw"></i>
                                <span class="nav-text">{{ __('web.Home') }}</span>
                            </div>
                            <div class="nav-item-hover"></div>
                        </a>
                    </li>
                    
                    <!-- About Link -->
                    <li class="nav-item mx-1">
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '#about-us') }}" class="nav-link nav-item-wrapper">
                            <div class="nav-item-content">
                                <i class="fas fa-info-circle fa-fw"></i>
                                <span class="nav-text">{{ __('web.About') }}</span>
                            </div>
                            <div class="nav-item-hover"></div>
                        </a>
                    </li>
                    
                    <!-- Services Dropdown -->
                    <li class="nav-item dropdown mx-1">
                        <a class="nav-link nav-item-wrapper dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-item-content">
                                <i class="fas fa-procedures fa-fw"></i>
                                @php
                            $appointmentsCount = \App\Models\Appointment::where('status', '!=', 'ملغي')
                                ->where('user_id', auth()->id())
                                ->whereHas('user', function($query) {
                                    $query->where('role', 1);
                                })
                                ->count();
                        @endphp
                                <span class="nav-text">{{ __('web.Services') }}</span>
                                @if ($appointmentsCount > 0)
                                <span id="unread-count-badge" class="badge bg-danger rounded-pill" style="font-size: 0.8rem; min-width: 20px; text-align: center;">
                                    {{ $appointmentsCount }}
                                </span>
                            @endif
                            </div>
                            <div class="nav-item-hover"></div>
                        </a>
                        <ul class="dropdown-menu dropdown-premium" aria-labelledby="servicesDropdown">
                            {{-- <li><a class="dropdown-item" href="{{ route('hospitals.index') }}">
                                <i class="fas fa-hospital me-2"></i>
                                {{ __('web.Hospitals') }}
                            </a></li> --}}
                            </a></li>


                            @php
                            $appointmentsCount = \App\Models\Appointment::where('status', '!=', 'ملغي')
                                ->where('user_id', auth()->id())
                                ->whereHas('user', function($query) {
                                    $query->where('role', 1);
                                })
                                ->count();
                        @endphp
                        
                        
                        <li>
                          
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('doctors.index') }}">
                                <div>
                                    <i class="fas fa-user-md me-2"></i>
                                    {{ __('web.Doctors') }}
                                </div>
                                @if ($appointmentsCount > 0)
                                    <span id="unread-count-badge" class="badge bg-danger rounded-pill" style="font-size: 0.8rem; min-width: 20px; text-align: center;">
                                        {{ $appointmentsCount }}
                                    </span>
                                @endif

                            </a>
                          
                        </li>
                        

                            
                            {{-- <li><a class="dropdown-item" href="{{ url('services/pediatrics') }}">
                                <i class="fas fa-calendar me-2"></i>
                                {{ __('web.Appointments') }}
                            </a></li> --}}
                        </ul>
                    </li>
                    
                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown mx-1">
                        <a class="nav-link nav-item-wrapper dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-item-content">
                                @php
                                $appointmesCount = \App\Models\Appointment::where('status', '=', 'confirmed')
                                    ->where('patient_id', auth()->id())
                                    
                                    ->count();
                            @endphp
                            

<i class="fas fa-user-circle fa-fw"></i>
<span class="nav-text">{{ __('web.Profile') }}</span>

@if ($appointmesCount > 0)
                        <span id="unread-count-badge" class="badge bg-danger rounded-pill" style="font-size: 0.8rem; min-width: 20px; text-align: center;">
                            {{ $appointmesCount }}
                        </span>
                    @endif


                    @php
                    $unreadCount = \DB::table('messages')
                        ->where('receiver_id', auth()->id())
                        ->where('is_read', false)
                        ->count();
                @endphp

@if ($unreadCount > 0)
                                    <span id="unread-count-badge" class="badge bg-danger rounded-pill" style="font-size: 0.8rem; min-width: 20px; text-align: center;">
                                        {{ $unreadCount }}
                                    </span>
                                @endif

                            </div>
                            <div class="nav-item-hover"></div>
                        </a>
                        <ul class="dropdown-menu dropdown-premium" aria-labelledby="profileDropdown">
                            <li>

                                @php
                                $appointmesCount = \App\Models\Appointment::where('status', '=', 'confirmed')
                                    ->where('patient_id', auth()->id())
                                    // ->where('user_id', $doctor->id) // هنا نربط الموعد بالدكتور المطلوب
                                   
                                    ->count();
                            @endphp


<a class="dropdown-item d-flex justify-content-between align-items-center" 
href="{{ Auth::check() ? route('patients.index') : route('login') }}">
 <div class="d-flex align-items-center">
     <i class="fas fa-id-card me-2 text-primary"></i>
     <span>{{ __('web.data') }}</span>
 </div>
 @if ($appointmesCount > 0)
     <span id="unread-count-badge" 
           class="badge bg-danger rounded-pill" 
           style="font-size: 0.75rem; min-width: 22px; text-align: center;">
         {{ $appointmesCount }}
     </span>
 @endif
</a>

                                
                            </li>
                            <li>
                                {{-- {{ __('web.viewTests') }} --}}
                                <a class="dropdown-item" href="{{ Auth::check() ? route('test.index') : route('login') }}">
                                    <div><i class="fas fa-flask me-2"></i>
                                    {{ __('web.Tests') }} </div>

                                </a>
                            </li>
                            {{-- <li><a class="dropdown-item" href="{{ route('chat.index') }}">
                                <i class="fas fa-stethoscope me-2"></i>
                                {{ __('web.Cons') }}
                            </a></li> --}}
                            @php
                            $unreadCount = \DB::table('messages')
                                ->where('receiver_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        
                        <li>
                                                       <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('chat.index') }}">
                                <div>
                                    <i class="fas fa-stethoscope me-2"></i>
                                    {{ __('web.Cons') }}
                                </div>
                                @if ($unreadCount > 0)
                                    <span id="unread-count-badge" class="badge bg-danger rounded-pill" style="font-size: 0.8rem; min-width: 20px; text-align: center;">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>
                        </li>

                       

                            
                        </ul>
                    </li>
                    
                    <!-- Contact Link -->
                    @if(Auth::user()->type == 1)

                    <li class="nav-item mx-1">
                        <a href="{{route('admin.index')}}" class="nav-link nav-item-wrapper">
                            <div class="nav-item-content">
                                <i class="fas fa-tachometer-alt fa-fw"></i>
                                <span class="nav-text">{{ __('web.DB') }}</span>
                            </div>
                            <div class="nav-item-hover"></div>
                        </a>
                    </li>
                    @endif
                </ul>

                <!-- Language Switcher -->
                <div class="d-flex align-items-center ms-lg-3">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if(app()->getLocale() != $localeCode)
                            <a class="btn btn-lang mx-1"
                               rel="alternate"
                               hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                               title="{{ $properties['native'] }}">
                                {{ strtoupper($localeCode) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </nav>
    </div>
</div>

<style>
/* Font Imports */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

/* حل مشكلة z-index */
.navbar-premium {
    position: relative;
    z-index: 1050; /* أعلى من معظم العناصر */
}

.dropdown-premium {
    z-index: 1060 !important; /* أعلى من النافبار */
}

/* Base Styles */
.navbar-premium {
    background: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,41,59,0.95) 100%);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    font-family: 'Poppins', 'Tajawal', sans-serif;
}

.navbar-premium.scrolled {
    background: rgba(15, 23, 42, 0.98);
    padding-top: 5px;
    padding-bottom: 5px;
}

/* Logo Styles */
.logo-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 12px;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.logo-text {
    background: linear-gradient(135deg, #E0E7FF 0%, #A5B4FC 50%, #818CF8 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-weight: 700;
    letter-spacing: 0.5px;
    font-size: 1.6rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Navigation Items */
.nav-item-wrapper {
    position: relative;
    padding: 0.5rem 1rem !important;
    margin: 0 0.25rem;
    border-radius: 8px;
    overflow: hidden;
}

.nav-item-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    transition: all 0.3s;
}

.nav-item-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(16, 185, 129, 0.2) 100%);
    opacity: 0;
    transition: all 0.3s;
    z-index: 1;
}

.nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s;
}

.nav-link i {
    font-size: 0.9rem;
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;
    transition: all 0.3s;
}

.nav-link:hover,
.nav-link.active {
    color: white !important;
}

.nav-link:hover .nav-item-content,
.nav-link.active .nav-item-content {
    transform: translateY(-2px);
}

.nav-link:hover i,
.nav-link.active i {
    color: #3B82F6;
    transform: scale(1.2);
}

.nav-link:hover .nav-item-hover,
.nav-link.active .nav-item-hover {
    opacity: 1;
}

.nav-text {
    position: relative;
}

/* Dropdown Menu */
.dropdown-premium {
    background: rgba(15, 23, 42, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    min-width: 220px;
}

.dropdown-item {
    color: rgba(255, 255, 255, 0.8) !important;
    padding: 0.5rem 1.5rem;
    margin: 0.15rem 0.5rem;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(16, 185, 129, 0.2) 100%);
    color: white !important;
    transform: translateX(5px);
}

.dropdown-item i {
    width: 20px;
    text-align: center;
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;
    color: #3B82F6;
}

/* Language Switcher */
.btn-lang {
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.8);
    border: none;
    border-radius: 8px;
    padding: 0.375rem 0.75rem;
    font-weight: 500;
    font-size: 0.8rem;
    transition: all 0.3s;
}

.btn-lang:hover {
    background: rgba(59, 130, 246, 0.2);
    color: white;
    transform: translateY(-2px);
}

/* Mobile Menu */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: rgba(15, 23, 42, 0.98);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .nav-item-wrapper {
        margin: 0.25rem 0;
    }
    
    .dropdown-premium {
        background: rgba(30, 41, 59, 0.95);
        margin-left: 1rem;
        margin-right: 1rem;
    }
}

/* RTL Adjustments */
[dir="rtl"] .dropdown-item:hover {
    transform: translateX(-5px);
}

[dir="rtl"] .navbar-premium {
    font-family: 'Tajawal', sans-serif;
}

[dir="rtl"] .nav-link i,
[dir="rtl"] .dropdown-item i {
    margin-right: 8px;
    margin-left: 0;
}

/* Dropdown Arrow */
.dropdown-toggle::after {
    display: inline-block;
    margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
    transition: transform 0.3s;
}

[dir="rtl"] .dropdown-toggle::after {
    margin-right: 0.255em;
    margin-left: 0;
}

.dropdown.show .dropdown-toggle::after {
    transform: rotate(180deg);
}

/* لمنع المحتوى من الظهور فوق القوائم المنسدلة */
.container:not(.navbar-premium .container) {
    position: relative;
    z-index: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-premium');
        navbar.classList.toggle('scrolled', window.scrollY > 30);
    });
    
    // Highlight active link
    const currentUrl = window.location.href;
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.href === currentUrl) {
            link.classList.add('active');
        }
    });
    
    // حل نهائي لمشكلة القوائم المنسدلة
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            // منع السلوك الافتراضي فقط للجوال
            if (window.innerWidth < 992) {
                e.preventDefault();
            }
            
            const dropdownMenu = this.nextElementSibling;
            const isOpen = this.classList.contains('show');
            
            // إغلاق جميع القوائم المفتوحة أولاً
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                }
            });
            
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                if (toggle !== this) {
                    toggle.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
            
            // فتح/إغلاق القائمة الحالية
            if (!isOpen) {
                this.classList.add('show');
                dropdownMenu.classList.add('show');
                this.setAttribute('aria-expanded', 'true');
            } else {
                this.classList.remove('show');
                dropdownMenu.classList.remove('show');
                this.setAttribute('aria-expanded', 'false');
            }
        });
    });
    
    // إغلاق القوائم عند النقر خارجها
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.classList.remove('show');
                toggle.setAttribute('aria-expanded', 'false');
            });
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    fetch("{{ route('chat.unreadCount') }}")
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('unread-count-badge');
            if (data.count > 0) {
                badge.textContent = data.count;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        })
        .catch(err => {
            console.error('Failed to fetch unread messages count', err);
        });
});

</script>