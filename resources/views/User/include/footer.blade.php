<div class="container-fluid footer-premium py-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="row g-4">
            <!-- Column 1: About -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo d-flex align-items-center mb-4">
                    <div class="logo-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h2 class="logo-text m-0">{{ __('web.title') }}</h2>
                </div>
                <p class="footer-about mb-4">
                    {{ __('web.footer_about_text') }}
                </p>
                <div class="footer-contact">
                    <div class="contact-item d-flex mb-3">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 شارع المدينة، الرياض، المملكة العربية السعودية</span>
                    </div>
                    <div class="contact-item d-flex mb-3">
                        <i class="fas fa-phone-alt"></i>
                        <span>+966 12 345 6789</span>
                    </div>
                    <div class="contact-item d-flex">
                        <i class="fas fa-envelope"></i>
                        <span>info@example.com</span>
                    </div>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h4 class="footer-title mb-4">{{ __('web.quick_links') }}</h4>
                <ul class="footer-links">
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '/') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            {{ __('web.Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '#about-us') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            {{ __('web.About') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('doctors.index') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            {{ __('web.Doctors') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('services/pediatrics') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            {{ __('web.Appointments') }}
                        </a>
                    </li>
                  
                </ul>
            </div>

            <!-- Column 3: Services -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-title mb-4">{{ __('web.our_services') }}</h4>
                <ul class="footer-links">
                    <li>
                        <a href="{{ route('test.index') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            {{ __('web.Tests') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ Auth::check() ? route('patients.index') : route('login') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>

     <span>{{ __('web.data') }}</span>

</a>
                    </li>
                    <li>
                        <li><a href="{{ route('chat.index') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            {{ __('web.Cons') }}
                        </a></li>
                    </li>
                  
                </ul>
            </div>

            <!-- Column 4: Newsletter -->
            {{-- <div class="col-lg-3 col-md-6">
                <h4 class="footer-title mb-4">{{ __('web.newsletter') }}</h4>
                <p class="newsletter-text mb-4">
                    {{ __('web.newsletter_text') }}
                </p>
                <form class="newsletter-form mb-4">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="{{ __('web.your_email') }}">
                        <button class="btn btn-send" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
                <h4 class="footer-title mb-3">{{ __('web.follow_us') }}</h4>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<!-- Footer Bottom -->
<div class="container-fluid footer-bottom py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">
                    &copy; {{ date('Y') }} {{ __('web.title') }}. {{ __('web.all_rights_reserved') }}
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="footer-links-bottom">
                    <a href="#">{{ __('web.privacy_policy') }}</a>
                    <a href="#">{{ __('web.terms_of_service') }}</a>
                    <a href="#">{{ __('web.sitemap') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Font Import */
@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

/* Footer Premium Styles */
.footer-premium {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #e2e8f0;
    font-family: 'Tajawal', sans-serif;
    position: relative;
    overflow: hidden;
}

.footer-premium::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: rgba(59, 130, 246, 0.1);
    border-radius: 50%;
    z-index: 0;
}

.footer-premium::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 200px;
    height: 200px;
    background: rgba(16, 185, 129, 0.1);
    border-radius: 50%;
    z-index: 0;
}

.footer-logo {
    position: relative;
    z-index: 1;
}

.footer-logo .logo-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 12px;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.footer-logo .logo-text {
    background: linear-gradient(135deg, #E0E7FF 0%, #A5B4FC 50%, #818CF8 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-weight: 700;
    font-size: 1.8rem;
}

.footer-about {
    font-size: 0.95rem;
    line-height: 1.7;
    position: relative;
    z-index: 1;
}

.footer-title {
    font-weight: 700;
    font-size: 1.2rem;
    color: #ffffff;
    position: relative;
    padding-bottom: 10px;
    z-index: 1;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
    border-radius: 3px;
}

.footer-links {
    list-style: none;
    padding: 0;
    position: relative;
    z-index: 1;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #cbd5e1;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.footer-links a:hover {
    color: #3B82F6;
    transform: translateX({{ app()->getLocale() == 'ar' ? '-5px' : '5px' }});
}

.footer-links i {
    font-size: 0.8rem;
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;
    color: #3B82F6;
}

.footer-contact {
    position: relative;
    z-index: 1;
}

.contact-item {
    align-items: center;
}

.contact-item i {
    color: #3B82F6;
    font-size: 1.1rem;
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 10px;
    width: 20px;
    text-align: center;
}

.newsletter-text {
    font-size: 0.95rem;
    line-height: 1.7;
    position: relative;
    z-index: 1;
}

.newsletter-form {
    position: relative;
    z-index: 1;
}

.newsletter-form .form-control {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: #ffffff;
    height: 45px;
    border-radius: 8px 0 0 8px;
}

.newsletter-form .form-control:focus {
    box-shadow: none;
    background: rgba(255, 255, 255, 0.15);
}

.newsletter-form .btn-send {
    background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
    color: white;
    border: none;
    height: 45px;
    width: 45px;
    border-radius: 0 8px 8px 0;
    transition: all 0.3s;
}

.newsletter-form .btn-send:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.social-links {
    display: flex;
    gap: 12px;
    position: relative;
    z-index: 1;
}

.social-link {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    color: #e2e8f0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.social-link:hover {
    background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
    color: white;
    transform: translateY(-3px);
}

/* Footer Bottom */
.footer-bottom {
    background: #0f172a;
    color: #94a3b8;
    font-size: 0.9rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.footer-links-bottom {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.footer-links-bottom a {
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.3s;
}

.footer-links-bottom a:hover {
    color: #3B82F6;
}

/* RTL Adjustments */
[dir="rtl"] .footer-logo .logo-icon {
    margin-right: 0;
    margin-left: 12px;
}

[dir="rtl"] .footer-links i {
    margin-right: 0;
    margin-left: 8px;
}

[dir="rtl"] .contact-item i {
    margin-right: 0;
    margin-left: 10px;
}

[dir="rtl"] .newsletter-form .form-control {
    border-radius: 0 8px 8px 0;
}

[dir="rtl"] .newsletter-form .btn-send {
    border-radius: 8px 0 0 8px;
}

/* Responsive */
@media (max-width: 767.98px) {
    .footer-title {
        margin-top: 20px;
    }
    
    .footer-links-bottom {
        justify-content: center;
        margin-top: 10px;
    }
    
    .footer-bottom .col-md-6 {
        text-align: center !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Newsletter Form Submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            if (emailInput.value) {
                // Here you can add AJAX call to submit the email
                alert('شكراً للاشتراك في نشرتنا البريدية!');
                emailInput.value = '';
            }
        });
    }
});
</script>