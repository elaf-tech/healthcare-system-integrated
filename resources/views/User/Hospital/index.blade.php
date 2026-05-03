@extends('User.master')
<base href="/public">
@section('content')

<div class="hospitals-page" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <!-- Hero Section with Parallax Effect -->
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title animate__animated animate__fadeInDown">{{ __('web.availableHos') }}</h1>
                <p class="hero-subtitle animate__animated animate__fadeInDown animate__delay-1s">{{ __('web.availableHosDet') }}</p>
                <div class=" ">
                    @if(Auth::check())
    <a href="{{ route('hospitals.create') }}" class="btn btn-primary btn-lg">
        <i class="fas fa-plus-circle me-2"></i> {{ __('web.addHos') }}
    </a>
@else
    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
        <i class="fas fa-plus-circle me-2"></i> {{ __('web.addHos') }}
    </a>
@endif
                    <a href="#hospitals" class="btn btn-outline-light btn-lg ms-3 scroll-down">
                        <i class="fas fa-arrow-down me-2"></i> {{ __('web.explore') }}
                    </a>
                </div>
            </div>
        </div>
        {{-- <div class="hero-wave">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="#fff"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="#fff"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#fff"></path>
            </svg>
        </div> --}}
    </div>

    <!-- Hospitals Grid -->
    <div class="container py-5" id="hospitals">
        <!-- Search and Filter Section -->
        <div class="hospital-filters mb-5 p-4 rounded-3 shadow-sm bg-white">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="search-box position-relative">
                        <i class="fas fa-search position-absolute"></i>
                        <input type="text" class="form-control ps-4" placeholder="{{ __('web.searchHospitals') }}" id="hospital-search">
                    </div>
                </div>
                <div class="col-md-3">
                    {{-- <select class="form-select" id="location-filter">
                        <option value="">{{ __('web.allLocations') }}</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}">{{ $location }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="col-md-3" hidden>
                    <select class="form-select" id="sort-filter">
                        <option value="">{{ __('web.sortBy') }}</option>
                        <option value="name_asc">{{ __('web.nameAsc') }}</option>
                        <option value="name_desc">{{ __('web.nameDesc') }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach($hospitals as $hospital)
            <div class="col-lg-4 col-md-6 hospital-item">
                <div class="hospital-card">
                    <div class="hospital-image">
                        <img src="{{ asset('storage/' . $hospital->image) }}" alt="{{ $hospital->name }}" loading="lazy">
                        <div class="hospital-badge">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <div class="hospital-overlay"></div>
                    </div>
                    
                    <div class="hospital-content">
                        <div class="hospital-header">
                            <h3>{{ $hospital->name }}</h3>
                            <div class="hospital-rating">
                                <i class="fas fa-star"></i> 4.8
                            </div>
                        </div>
                        
                        <div class="hospital-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $hospital->address }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-phone"></i>
                                <a href="tel:{{ $hospital->hospital_phone }}" class="text-decoration-none">{{ $hospital->hospital_phone }}</a>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-user-tie"></i>
                                <span>{{ __('web.owner') }}: {{ $hospital->owner_name }}</span>
                            </div>
                        </div>

                        <div class="hospital-actions">
                            @if ($hospital->user_id === auth()->id())
                                {{-- <a href="{{ route('doctors.show', $hospital->id) }}" class="btn btn-action btn-sm">
                                    <i class="fas fa-user-md"></i>
                                    <span>{{__('web.showDoc')}}</span>
                                </a> --}}
                                <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-action btn-sm">
                                    <i class="fas fa-edit"></i>
                                    <span>{{__('web.EditHos')}}</span>
                                </a>
                            @else
                           
                                <button class="btn btn-action btn-sm" disabled>
                                    <i class="fas fa-edit"></i>
                                    <span>{{__('web.EditHos')}}</span>
                                </button>
                            @endif
                            <a href="{{ route('hospitals.showDoctors', $hospital->id) }}" class="btn btn-action btn-sm">
                                <i class="fas fa-user-md"></i>
                                <span>{{__('web.showDoc')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $hospitals->links() }}
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<a href="{{ route('hospitals.create') }}" class="fab">
    <i class="fas fa-plus"></i>
</a>

<!-- Back to Top Button -->
<a href="#" class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<style>
/* Fonts */
@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

:root {
    --primary: #3498db;
    --primary-dark: #2980b9;
    --secondary: #2ecc71;
    --secondary-dark: #27ae60;
    --dark: #2c3e50;
    --light: #f8f9fa;
    --gray: #7f8c8d;
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

body {
    font-family: 'Tajawal', sans-serif;
    background-color: #f8fafc;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: white;
    padding: 8rem 0 10rem;
    position: relative;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(52, 152, 219, 0.8), rgba(46, 204, 113, 0.8));
    z-index: 0;
}

.hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.hero-subtitle {
    font-size: 1.4rem;
    opacity: 0.9;
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.hero-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 150px;
}

.hero-wave svg {
    width: 100%;
    height: 100%;
}

/* Search and Filters */
.hospital-filters {
    background: white;
    border: 1px solid rgba(0,0,0,0.05);
}

.search-box i {
    top: 50%;
    transform: translateY(-50%);
    left: 15px;
    color: var(--gray);
}

.search-box input {
    padding-left: 40px;
    border-radius: 8px;
    height: 50px;
    border: 1px solid #e0e0e0;
    transition: var(--transition);
}

.search-box input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

.form-select {
    height: 50px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: var(--transition);
}

.form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

/* Hospital Card */
.hospital-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
    position: relative;
    border: none;
}

.hospital-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.hospital-image {
    height: 220px;
    overflow: hidden;
    position: relative;
}

.hospital-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.hospital-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    opacity: 0;
    transition: var(--transition);
}

.hospital-card:hover .hospital-overlay {
    opacity: 1;
}

.hospital-card:hover .hospital-image img {
    transform: scale(1.1);
}

.hospital-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    z-index: 2;
}

.hospital-content {
    padding: 1.5rem;
}

.hospital-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.hospital-header h3 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
    flex: 1;
}

.hospital-rating {
    background: rgba(52, 152, 219, 0.1);
    color: var(--primary);
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
}

.hospital-rating i {
    color: #f39c12;
    margin-left: 5px;
}

.hospital-meta {
    margin: 1.5rem 0;
}

.meta-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.8rem;
}

.meta-item i {
    color: var(--primary);
    margin-left: 8px;
    width: 20px;
    text-align: center;
    font-size: 1rem;
}

.meta-item span, .meta-item a {
    color: var(--dark);
    font-size: 0.95rem;
}

.meta-item a:hover {
    color: var(--primary);
    text-decoration: none;
}

.hospital-actions {
    display: flex;
    gap: 10px;
    margin-top: 1.5rem;
}

.btn-action {
    flex: 1;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: var(--transition);
    font-size: 0.9rem;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    color: white;
    background: linear-gradient(135deg, var(--primary-dark), var(--secondary-dark));
}

.btn-action:disabled {
    background: #bdc3c7;
    cursor: not-allowed;
    box-shadow: none;
}

.btn-action i {
    font-size: 0.9rem;
}

/* Add Hospital Button */
.btn-add-hospital {
    background: white;
    color: var(--primary);
    border: none;
    border-radius: 30px;
    padding: 12px 30px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
}

.btn-add-hospital:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    color: var(--primary-dark);
}

.btn-add-hospital i {
    font-size: 1.3rem;
    transition: transform 0.3s;
}

.btn-add-hospital:hover i {
    transform: rotate(90deg);
}

.btn-outline-light {
    border: 2px solid white;
    background: transparent;
    color: white;
    transition: var(--transition);
}

.btn-outline-light:hover {
    background: white;
    color: var(--primary);
}

/* Floating Action Button */
.fab {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: 0 5px 20px rgba(52, 152, 219, 0.4);
    transition: var(--transition);
    z-index: 1000;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.5s ease forwards 1s;
}

.fab:hover {
    transform: translateY(-5px) scale(1.1);
    color: white;
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.5);
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: rgba(0,0,0,0.7);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: var(--transition);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
}

.back-to-top.active {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    background: var(--dark);
    color: white;
    transform: translateY(-3px);
}

/* Scroll Down Button */
.scroll-down {
    transition: var(--transition);
}

.scroll-down:hover {
    transform: translateY(5px);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Pagination */
.pagination {
    display: flex;
    gap: 8px;
}

.page-item .page-link {
    border-radius: 8px !important;
    border: 1px solid #dee2e6;
    color: var(--primary);
    transition: var(--transition);
}

.page-item.active .page-link {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
}

.page-item:hover .page-link {
    background: rgba(52, 152, 219, 0.1);
}

/* Responsive */
@media (max-width: 1200px) {
    .hero-title {
        font-size: 3rem;
    }
}

@media (max-width: 992px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 6rem 0 8rem;
        background-attachment: scroll;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .hospital-image {
        height: 200px;
    }
    
    .btn-add-hospital {
        padding: 10px 20px;
        font-size: 1rem;
    }
    
    .hospital-filters .row {
        gap: 15px 0;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .hero-actions {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-outline-light {
        margin-left: 0 !important;
    }
    
    .hospital-actions {
        flex-direction: column;
    }
    
    .fab, .back-to-top {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
        bottom: 20px;
        right: 20px;
    }
    
    .back-to-top {
        bottom: 90px;
    }
}
</style>
{{-- 
<script> --}}
{{-- 
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Back to Top Button
    const backToTopButton = document.querySelector('.back-to-top');
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('active');
        } else {
            backToTopButton.classList.remove('active');
        }
    });
    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Search & Filter with debounce
    const searchInput = document.getElementById('hospital-search');
    const sortFilter = document.getElementById('sort-filter');
    let debounceTimer;

    function filterHospitals() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const sortValue = sortFilter.value;

        let hospitalItems = Array.from(document.querySelectorAll('.hospital-item'));

        // Filter by search
        hospitalItems.forEach(item => {
            const name = item.querySelector('h3').textContent.toLowerCase();
            if (searchTerm === '' || name.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });

        // Sort by name
        if (sortValue.includes('name')) {
            hospitalItems.sort((a, b) => {
                const nameA = a.querySelector('h3').textContent.toLowerCase();
                const nameB = b.querySelector('h3').textContent.toLowerCase();
                return sortValue === 'name_asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
            });

            const container = document.querySelector('.row.g-4');
            hospitalItems.forEach(item => container.appendChild(item));
        }
    }

    // Add debounce
    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(filterHospitals, 300); // 300ms delay
    });

    sortFilter.addEventListener('change', filterHospitals);

    // Initial filter on page load (optional)
    filterHospitals();
});
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Back to Top Button
        const backToTopButton = document.querySelector('.back-to-top');
        window.addEventListener('scroll', () => {
            backToTopButton.classList.toggle('active', window.pageYOffset > 300);
        });
        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    
        // Elements
        const searchInput = document.getElementById('hospital-search');
        const sortFilter = document.getElementById('sort-filter');
        let debounceTimer;
    
        function filterHospitals() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            const sortValue = sortFilter.value;
            let hospitalItems = Array.from(document.querySelectorAll('.hospital-item'));
    
            hospitalItems.forEach(item => {
                const name = item.querySelector('h3').textContent.toLowerCase();
                const address = item.querySelector('.meta-item span').textContent.toLowerCase();
                const ownerText = Array.from(item.querySelectorAll('.meta-item span'))
                    .find(span => span.textContent.toLowerCase().includes('owner') || span.textContent.toLowerCase().includes('المالك') || span.textContent.toLowerCase().includes('owner'))
                    ?.textContent.toLowerCase() || '';
                const phone = item.querySelector('.meta-item a').textContent.toLowerCase();
    
                const matches = 
                    name.includes(searchTerm) ||
                    address.includes(searchTerm) ||
                    ownerText.includes(searchTerm) ||
                    phone.includes(searchTerm) ||
                    searchTerm === '';
    
                item.style.display = matches ? '' : 'none';
            });
    
            // Sort by name
            if (sortValue.includes('name')) {
                hospitalItems.sort((a, b) => {
                    const nameA = a.querySelector('h3').textContent.toLowerCase();
                    const nameB = b.querySelector('h3').textContent.toLowerCase();
                    return sortValue === 'name_asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
                });
                const container = document.querySelector('.row.g-4');
                hospitalItems.forEach(item => container.appendChild(item));
            }
        }
    
        // Debounce input
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(filterHospitals, 300);
        });
        sortFilter.addEventListener('change', filterHospitals);
    
        // Initial filter
        filterHospitals();
    });
    </script>
    
@endsection