<div class="top-bar elite" dir="{{ app()->getLocale() == 'ar' ? 'ltr' : 'rtl' }}">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <!-- معلومات التواصل -->
            <div class="d-flex elite-contact">
                <a href="tel:+0123456789" class="elite-contact-item">
                    <i class="fas fa-phone-alt pulse"></i>
                    <span>+012 345 6789</span>
                </a>
                <a href="mailto:info@example.com" class="elite-contact-item">
                    <i class="fas fa-envelope pulse"></i>
                    <span>info@example.com</span>
                </a>
            </div>

            <!-- وسائل التواصل + تسجيل الدخول -->
            <div class="d-flex align-items-center">
                <!-- وسائل التواصل -->
                <div class="elite-social">
                    <a href="#" class="elite-social-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="elite-social-icon" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="elite-social-icon" title="Instagram"><i class="fab fa-instagram"></i></a>
                </div>

                <!-- زر تسجيل الدخول -->
                @auth
                <div class="elite-auth-buttons">
                    <div class="elite-user-profile">
                        <div class="elite-user-avatar">
                            <span class="user-avatar"><i class="fas fa-user-circle"></i></span> <!-- استخدام أيقونة المستخدم -->
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="elite-logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span> {{__('web.Logout')}}</span>
                        </button>
                    </form>
                </div>
                @else
                <div class="elite-auth-buttons">
                    <a href="{{ route('login') }}" class="elite-login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        <span> {{__('web.Login')}}</span>
                    </a>
                    <a href="{{ route('register') }}" class="elite-register-btn">
                        <i class="fas fa-user-plus"></i>
                        <span> {{__('web.Register')}}</span>
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
/* التصميم العام */
.elite {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    font-size: 14px;
    padding: 10px 0;
    position: relative;
    z-index: 1000;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* معلومات التواصل */
.elite-contact {
    display: flex;
    gap: 25px;
}

.elite-contact-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    transition: all 0.3s;
}

.elite-contact-item:hover {
    color: white;
    transform: translateY(-2px);
}

.elite-contact-item i {
    font-size: 16px;
    color: #2ecc71;
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* وسائل التواصل */
.elite-social {
    display: flex;
    gap: 12px;
    margin-right: 20px;
}

.elite-social-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.1);
    color: white;
    transition: all 0.3s;
}

.elite-social-icon:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-3px) rotate(5deg);
}

/* أزرار تسجيل الدخول */
.elite-auth-buttons {
    display: flex;
    gap: 10px;
    align-items: center;
}

.elite-login-btn, .elite-register-btn, .elite-logout-btn {
    padding: 8px 20px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.elite-login-btn {
    background: rgba(255,255,255,0.15);
    color: white;
}

.elite-register-btn {
    background: white;
    color: #3498db;
}

.elite-logout-btn {
    background: rgba(255, 99, 71, 0.2);
    color: white;
    border: none;
    cursor: pointer;
}

.elite-login-btn:hover {
    background: rgba(255,255,255,0.25);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.elite-register-btn:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.elite-logout-btn:hover {
    background: rgba(255, 99, 71, 0.3);
    transform: translateY(-2px);
}

/* تصميم ملف المستخدم */
.elite-user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 5px 15px;
    border-radius: 30px;
    background: rgba(255,255,255,0.1);
}

.elite-user-avatar {
    width: 30px;
    height: 30px;
    background: white;
    color: #3498db;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* تعديلات للغة العربية */
[dir="rtl"] .elite-social {
    margin-right: 0;
    margin-left: 20px;
}

/* التجاوب مع الجوال */
@media (max-width: 768px) {
    .elite-contact {
        display: none;
    }
    
    .elite-auth-buttons {
        gap: 5px;
    }
    
    .elite-login-btn, .elite-register-btn, .elite-logout-btn {
        padding: 8px 12px;
    }
    
    .elite-login-btn span, 
    .elite-register-btn span,
    .elite-logout-btn span {
        display: none;
    }
    
    .elite-user-profile span {
        display: none;
    }
}
</style>