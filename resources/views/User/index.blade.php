@extends('User.master')
@section('content')
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluidd" src="User/img/hero.jpg" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-sm-10 col-lg-8 text-center">
                            <h4 class="text-primary text-uppercase mb-3 animated slideInDown">{{__('web.first_cors_head')}}    </h4>
                            <h2 class="display-3 text-white animated slideInDown"> {{__('web.first_cors_head2')}} </h2>
                            <p class="fs-5 text-white mb-4 pb-2">{{__('web.first_cors_p')}} 
                            </p>
                            <a href="{{route('patients.index')}}" class="btn btn-light py-md-3 px-md-5 animated slideInRight"> {{__('web.Start')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluidd" src="User/img/heroo.png" alt="">
        
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-sm-10 col-lg-8 text-center">
                            <h4 class="text-primary text-uppercase mb-3 animated slideInDown">{{__('web.second_cors_head')}}    </h4>
                            <h2 class="display-3 text-white animated slideInDown"> {{__('web.second_cors_head2')}} </h2>
                            <p class="fs-5 text-white mb-4 pb-2">{{__('web.second_cors_p')}} 
                            </p>
                            <a href="{{route('patients.index')}}" class="btn btn-light py-md-3 px-md-5 animated slideInRight"> {{__('web.Start')}}</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="owl-carousel-item position-relative">
            <img class="img-fluidd" src="User/img/herooo.png" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-10 col-lg-8 text-center">
                            <h4 class="text-primary text-uppercase mb-3 animated slideInDown">{{__('web.third_cors_head')}}    </h4>
                            <h2 class="display-3 text-white animated slideInDown"> {{__('web.third_cors_head2')}} </h2>
                            <p class="fs-5 text-white mb-4 pb-2">{{__('web.third_cors_p')}} 
                            </p>
                            <a href="{{route('patients.index')}}" class="btn btn-light py-md-3 px-md-5 animated slideInRight"> {{__('web.Start')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="User/img/about.jpg" alt="" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                <h1 class="mb-4">Welcome to eLEARNING</h1>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
            </div>
        </div>
    </div>
</div> --}}<div class="about-section" id="about-us" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <!-- Background Waves -->
    <div class="about-waves">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="#3498db"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="#3498db"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#3498db"></path>
        </svg>
    </div>

    <div class="container">
        <div class="row gx-5 align-items-center">
            <!-- Image Column -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="about-image-wrapper">
                    <img class="about-main-image" src="User/img/about.jpg" alt="About Us">
                    <div class="about-image-overlay"></div>
                    <div class="about-experience animate__animated animate__pulse animate__infinite">
                        <span class="experience-years">10+</span>
                        <span class="experience-text">{{ __('web.YearsExperience') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-header mb-4">
                        <h5 class="section-subtitle text-gradient">{{ __('web.About') }}</h5> <br>
                        <h1 class="section-title">{{ __('web.aboutHead') }}</h1>
                    </div>
                    
                    <p class="about-description">
                        {{ __('web.aboutDetails') }}
                    </p>
                    
                    <!-- Features Grid -->
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="feature-count">50+</h3>
                                    <p class="feature-title">{{ __('web.Doctors') }}</p>
                                    <p class="feature-subtitle">{{ __('web.Qualified') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-6">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-procedures"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="feature-count">24/7</h3>
                                    <p class="feature-title">{{ __('web.Services') }}</p>
                                    <p class="feature-subtitle">{{ __('web.Emergency') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-6">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-microscope"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="feature-count">100%</h3>
                                    <p class="feature-title">{{ __('web.Testing') }}</p>
                                    <p class="feature-subtitle">{{ __('web.Accurate') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-6">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <div class="feature-content">
                                    <h3 class="feature-count">Free</h3>
                                    <p class="feature-title">{{ __('web.Ambulance') }}</p>
                                    <p class="feature-subtitle">{{ __('web.Free') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Call to Action -->
                    <div class="about-cta mt-4">
                        <a href="{{route('patients.index')}}" class="btn btn-primary btn-cta">
                            {{ __('web.Start') }}
                            <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Import Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

/* About Section */
.about-section {
    position: relative;
    padding: 100px 0;
    background-color: #f8fafc;
    overflow: hidden;
}

.about-waves {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 150px;
    z-index: 1;
}

.about-waves svg {
    width: 100%;
    height: 100%;
}

/* Image Styles */
.about-image-wrapper {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    height: 500px;
}

.about-main-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.about-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(52, 152, 219, 0.1), rgba(46, 204, 113, 0.3));
}

.about-experience {
    position: absolute;
    bottom: 30px;
    {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 30px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    z-index: 2;
}

.experience-years {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #3498db;
    line-height: 1;
}

.experience-text {
    font-size: 1rem;
    color: #2c3e50;
    font-weight: 600;
}

/* Content Styles */
.about-content {
    position: relative;
    z-index: 2;
    padding: 0 20px;
}

.section-header {
    margin-bottom: 30px;
}

.section-subtitle {
    display: inline-block;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    background: linear-gradient(135deg, #3498db, #2ecc71);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    line-height: 1.3;
}

.about-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #5a6a7e;
    margin-bottom: 30px;
}

/* Feature Cards */
.feature-card {
    background: white;
    border-radius: 10px;
    padding: 20px 15px;
    text-align: center;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.03);
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 15px;
    background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(46, 204, 113, 0.1));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-icon i {
    font-size: 1.5rem;
    color: #3498db;
}

.feature-count {
    font-size: 1.5rem;
    font-weight: 700;
    color: #3498db;
    margin-bottom: 5px;
}

.feature-title {
    font-size: 1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.feature-subtitle {
    font-size: 0.85rem;
    color: #7f8c8d;
}

/* Call to Action */
.btn-cta {
    padding: 12px 30px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 1.1rem;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
}

.btn-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.btn-cta:hover::before {
    left: 100%;
}

/* Responsive Styles */
@media (max-width: 1199.98px) {
    .section-title {
        font-size: 2.2rem;
    }
}

@media (max-width: 991.98px) {
    .about-section {
        padding: 80px 0;
    }
    
    .about-image-wrapper {
        height: 400px;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 767.98px) {
    .about-section {
        padding: 60px 0;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .about-content {
        padding: 0;
        margin-top: 30px;
    }
    
    .feature-card {
        padding: 15px 10px;
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
    }
    
    .feature-count {
        font-size: 1.3rem;
    }
}

@media (max-width: 575.98px) {
    .section-title {
        font-size: 1.6rem;
    }
    
    .about-description {
        font-size: 1rem;
    }
    
    .feature-card {
        margin-bottom: 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation on scroll
    const aboutSection = document.querySelector('.about-section');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const features = document.querySelectorAll('.feature-card');
                features.forEach((feature, index) => {
                    setTimeout(() => {
                        feature.classList.add('animate__animated', 'animate__fadeInUp');
                    }, index * 100);
                });
            }
        });
    }, { threshold: 0.1 });

    observer.observe(aboutSection);
});
</script>
</div>
@stop

<style>
    .img-fluidd{
        height: 530px; /* الحفاظ على نسبة الارتفاع */

    }
</style>