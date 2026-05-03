@extends('User.master')
<base href="/public">
@section('content')

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
                <h2>لوحة التحكم</h2>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <li class="active">
                <a href="#dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>الرئيسية</span>
                </a>
            </li>
            <li>
                {{-- <a href="#users-table">
                    <i class="fas fa-users"></i>
                    <span>المستخدمين</span>
                </a> --}}
            </li>
            <li>
                <a href="#doctors-table">
                    <i class="fas fa-user-md"></i>
                    <span>الأطباء</span>
                </a>
            </li>
            <li>
                <a href="#bookings-table">
                    <i class="fas fa-calendar-check"></i>
                    <span>الحجوزات</span>
                </a>
            </li>
            <li>
                <a href="#patients-table">
                    <i class="fas fa-user-injured"></i>
                    <span>المرضى</span>
                </a>
            </li>
            <li>
                <a href="#tests-table">
                    <i class="fas fa-flask"></i>
                    <span>التحاليل</span>
                </a>
            </li>
            <li>
                <a href="#system-users-table">
                    <i class="fas fa-user-shield"></i>
                    <span>مستخدمي النظام</span>
                </a>
            </li>
            <li>
                <a href="#consultations-table">
                    <i class="fas fa-comments"></i>
                    <span>الاستشارات</span>
                </a>
            </li>
            <li>
                <a href="#settings">
                    <i class="fas fa-cog"></i>
                    <span>الإعدادات</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <div class="user-profile">
                <img src="/images/admin-avatar.jpg" alt="صورة المدير">
                <div class="user-info">
                    <h4>أحمد محمد</h4>
                    <span>مدير النظام</span>
                </div>
            </div>
            <a href="#" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>تسجيل الخروج</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navigation -->
        {{-- <nav class="top-nav">
            <div class="nav-left">
                <button class="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="search-box">
                    <input type="text" placeholder="ابحث هنا...">
                    <button><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="nav-right">
                <div class="notifications">
                    <i class="fas fa-bell"></i>
                    <span class="badge">5</span>
                </div>
                <div class="messages">
                    <i class="fas fa-envelope"></i>
                    <span class="badge">3</span>
                </div>
            </div>
        </nav> --}}

        <!-- Dashboard Content -->
        <div class="content-wrapper">
            <h1 class="page-title" id="dashboard">لوحة التحكم</h1>
            
            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="card-info">
                        <h3>{{$adminUsersCount}}</h3>
                        <p>مدراء النظام</p>
                    </div>
                    <div class="card-action">
                        <a href="{{ route('admin.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus-circle"></i> إضافة مدير
                        </a>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-info" id="users-table">
                        <h3>{{$regularUsersCount}}</h3>
                        <p>المستخدمين</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="card-info">
                        <h3>{{$doctorsCount}}</h3>
                        <p>الأطباء</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-info">
                        <h3>{{$bookingsCount}}</h3>
                        <p>الحجوزات</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <div class="card-info">
                        <h3>{{$patientcount}}</h3>
                        <p>المرضى</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="card-info">
                        <h3>{{$testcount}}</h3>
                        <p>التحاليل</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="card-info">
                        <h3>{{$concount}}</h3>
                        <p>استشارات</p>
                    </div>
                </div>
            </div>
            
            <!-- Recent Appointments -->
            <div class="card" id="bookings-table">
                <div class="card-header">
                    <h3>آخر الحجوزات</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المريض</th>
                                    <th>الطبيب</th>
                                    <th>التاريخ</th>
                                    <th>الوقت</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($res as $res)
                                <tr>
                                    <td>{{$res->id}}</td>
                                    <td>{{$res->patient->full_name ?? 'غير معروف'}}</td>
                                    <td>{{$res->user->name ?? 'غير معروف'}}</td>
                                    <td>{{$res->time}}</td>
                                    <td>{{$res->day}}</td>
                                    <td>{{$res->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Doctors List -->
            <div class="card" id="doctors-table">
                <div class="card-header">
                    <h3>قائمة الأطباء</h3>
                </div>
                <div class="card-body">
                    <div class="doctors-grid">
                        @foreach ($doc as $d)
                        <div class="doctor-card">
                            <img src="{{ asset('storage/' . $d->image) }}" alt="{{ $d->name }}" loading="lazy">
                            <h4>{{$d->name}}</h4>
                            <p>{{$d->email}}</p>
                            <p>{{$d->specialization}}</p>
                            <p>{{$d->phone}}</p>
                            <div class="doctor-actions">
                                {{-- <button class="btn btn-primary">التفاصيل</button> --}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Patients Table -->
            <div class="card" id="patients-table">
                <div class="card-header">
                    <h3>المرضى</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المريض</th>
                                    <th>تاريخ الميلاد</th>
                                    <th>الجنس</th>
                                    <th>رقم الهوية</th>
                                    <th>رقم الهاتف</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>العنوان</th>
                                    <th>الأمراض المزمنة</th>
                                    <th>الأدوية الحالية</th>
                                    <th>الحساسية</th>
                                    <th>الوزن</th>
                                    <th>الطول</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pat as $res)
                                <tr>
                                    <td>{{$res->id}}</td>
                                    <td>{{$res->full_name ?? 'غير معروف'}}</td>
                                    <td>{{$res->date_of_birth ?? 'غير معروف'}}</td>
                                    <td>{{$res->gender ?? 'غير معروف'}}</td>
                                    <td>{{$res->identity_number ?? 'غير معروف'}}</td>
                                    <td>{{$res->phone_number ?? 'غير معروف'}}</td>
                                    <td>{{$res->email ?? 'غير معروف'}}</td>
                                    <td>{{$res->address ?? 'غير معروف'}}</td>
                                    <td>{{$res->chronic_diseases ?? 'غير معروف'}}</td>
                                    <td>{{$res->current_medications ?? 'غير معروف'}}</td>
                                    <td>{{$res->allergies ?? 'غير معروف'}}</td>
                                    <td>{{$res->weight ?? 'غير معروف'}}</td>
                                    <td>{{$res->height ?? 'غير معروف'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tests Table -->
            <div class="card" id="tests-table">
                <div class="card-header">
                    <h3>التحاليل</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المريض</th>
                                    <th>اسم الطبيب</th>
                                    <th>نوع التحليل</th>
                                    <th>تاريخ التحليل</th>
                                    <th>قيمة التحليل</th>
                                    <th>الوحدة</th>
                                    <th>الملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($test as $t)
                                <tr>
                                    <td>{{$t->id}}</td>
                                    <td>{{$t->patient->full_name ?? 'غير معروف'}}</td>
                                    <td>{{$t->user->name ?? 'غير معروف'}}</td>
                                    <td>{{$t->test_type}}</td>
                                    <td>{{$t->test_date}}</td>
                                    <td>{{$t->result_value}}</td>
                                    <td>{{$t->unit}}</td>
                                    <td>{{$t->notes ?? 'غير معروف'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- System Users Table -->
            <div class="card" id="system-users-table">
                <div class="card-header">
                    <h3>مستخدمي النظام</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الدور</th>
                                    <th>الصلاحية</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->type}}</td>
                                    <td>
                                        <a href="{{route('admin.edit',$user->id)}}" class="btn btn-sm btn-primary">تعديل</a>
                                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟');">حذف</button>
                                        </form>                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Consultations Table -->
            <div class="card" id="consultations-table">
                <div class="card-header">
                    <h3>الاستشارات</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المريض</th>
                                    <th>نوع الاستشارة</th>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- سيتم إضافة بيانات الاستشارات هنا -->
                                <tr>
                                    <td colspan="5" class="text-center">لا توجد استشارات متاحة</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="card" id="settings">
                <div class="card-header">
                    <h3>الإعدادات</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>إعدادات النظام</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="notifications">
                                <label class="form-check-label" for="notifications">تفعيل الإشعارات</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>


<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --dark-color: #1b263b;
        --light-color: #f8f9fa;
        --success-color: #4cc9f0;
        --warning-color: #f8961e;
        --danger-color: #f72585;
        --sidebar-width: 250px;
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Tajawal', sans-serif;
    }
    
    body {
        background-color: #f5f7fa;
        color: #333;
        direction: rtl;
    }
    
    /* Layout */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }
    
    /* Sidebar */
    .sidebar {
        width: var(--sidebar-width);
        background: linear-gradient(180deg, var(--dark-color) 0%, #2a3a5e 100%);
        color: white;
        position: fixed;
        height: 100vh;
        transition: all 0.3s;
        z-index: 1000;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .logo i {
        font-size: 24px;
        color: var(--accent-color);
    }
    
    .logo h2 {
        font-size: 18px;
        font-weight: 700;
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 15px 0;
    }
    
    .sidebar-menu li {
        margin: 5px 0;
    }
    
    .sidebar-menu li a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .sidebar-menu li a i {
        margin-left: 10px;
        font-size: 16px;
    }
    
    .sidebar-menu li a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .sidebar-menu li.active a {
        background-color: var(--primary-color);
        color: white;
        border-right: 3px solid var(--accent-color);
    }
    
    .sidebar-footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .user-profile {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-left: 10px;
    }
    
    .user-info h4 {
        font-size: 14px;
        margin-bottom: 3px;
    }
    
    .user-info span {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }
    
    .logout-btn {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .logout-btn:hover {
        color: white;
    }
    
    .logout-btn i {
        margin-left: 8px;
    }
    
    /* Main Content */
    .main-content {
        flex: 1;
        margin-right: var(--sidebar-width);
        transition: all 0.3s;
    }
    
    /* Top Navigation */
    .top-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .nav-left {
        display: flex;
        align-items: center;
    }
    
    .sidebar-toggle {
        background: none;
        border: none;
        font-size: 18px;
        color: var(--dark-color);
        cursor: pointer;
        margin-left: 15px;
    }
    
    .search-box {
        display: flex;
        align-items: center;
        background-color: #f5f7fa;
        border-radius: 8px;
        padding: 5px 10px;
    }
    
    .search-box input {
        border: none;
        background: none;
        padding: 5px;
        width: 200px;
        outline: none;
    }
    
    .search-box button {
        background: none;
        border: none;
        color: var(--dark-color);
        cursor: pointer;
    }
    
    .nav-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .notifications, .messages {
        position: relative;
        cursor: pointer;
    }
    
    .notifications i, .messages i {
        font-size: 18px;
        color: var(--dark-color);
    }
    
    .badge {
        position: absolute;
        top: -5px;
        left: -5px;
        background-color: var(--danger-color);
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Content Wrapper */
    .content-wrapper {
        padding: 20px;
    }
    
    .page-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: var(--dark-color);
    }
    
    /* Stats Cards */
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
        color: white;
        font-size: 20px;
    }
    
    .card-icon.bg-primary {
        background-color: var(--primary-color);
    }
    
    .card-icon.bg-success {
        background-color: var(--success-color);
    }
    
    .card-icon.bg-warning {
        background-color: var(--warning-color);
    }
    
    .card-icon.bg-danger {
        background-color: var(--danger-color);
    }
    
    .card-info h3 {
        font-size: 24px;
        margin-bottom: 5px;
    }
    
    .card-info p {
        font-size: 14px;
        color: #666;
    }
    
    /* Cards */
    .card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }
    
    .card-header h3 {
        font-size: 18px;
        color: var(--dark-color);
    }
    
    .view-all {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 14px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    /* Tables */
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th, .table td {
        padding: 12px 15px;
        text-align: right;
        border-bottom: 1px solid #eee;
    }
    
    .table th {
        background-color: #f9fafb;
        color: var(--dark-color);
        font-weight: 500;
    }
    
    .table tr:hover {
        background-color: #f9fafb;
    }
    
    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .badge.bg-success {
        background-color: var(--success-color);
        color: white;
    }
    
    .badge.bg-warning {
        background-color: var(--warning-color);
        color: white;
    }
    
    .badge.bg-danger {
        background-color: var(--danger-color);
        color: white;
    }
    
    .btn {
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s;
    }
    
    .btn-sm {
        padding: 3px 8px;
        font-size: 12px;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }
    
    .btn-danger {
        background-color: var(--danger-color);
        color: white;
    }
    
    .btn i {
        margin-left: 5px;
    }
    
    /* Doctors Grid */
    .doctors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .doctor-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 20px;
        text-align: center;
        transition: all 0.3s;
    }
    
    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .doctor-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid var(--accent-color);
    }
    
    .doctor-card h4 {
        font-size: 16px;
        margin-bottom: 5px;
    }
    
    .doctor-card p {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }
    
    .doctor-rating {
        margin-bottom: 15px;
    }
    
    .doctor-rating i {
        color: #ffc107;
        font-size: 14px;
    }
    
    .doctor-rating span {
        margin-right: 5px;
        font-weight: 500;
    }
    
    .doctor-actions .btn {
        width: 100%;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }
        
        .main-content {
            margin-right: 0;
        }
        
        .sidebar.active {
            transform: translateX(0);
        }
        
        .main-content.active {
            margin-right: var(--sidebar-width);
        }
    }
    
    @media (max-width: 768px) {
        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .doctors-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .stats-cards {
            grid-template-columns: 1fr;
        }
        
        .doctors-grid {
            grid-template-columns: 1fr;
        }
        
        .nav-left {
            width: 100%;
        }
        
        .search-box {
            flex: 1;
        }
        
        .search-box input {
            width: 100%;
        }
    }
    </style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Sidebar
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('active');
    });
    
    // Smooth scrolling for sidebar links
    document.querySelectorAll('.sidebar-menu a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all menu items
            document.querySelectorAll('.sidebar-menu li').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to clicked menu item
            this.parentElement.classList.add('active');
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Highlight active menu item based on scroll position
    window.addEventListener('scroll', function() {
        const fromTop = window.scrollY + 100;
        
        document.querySelectorAll('.sidebar-menu a[href^="#"]').forEach(link => {
            const section = document.querySelector(link.getAttribute('href'));
            
            if (
                section &&
                section.offsetTop <= fromTop &&
                section.offsetTop + section.offsetHeight > fromTop
            ) {
                document.querySelectorAll('.sidebar-menu li').forEach(item => {
                    item.classList.remove('active');
                });
                link.parentElement.classList.add('active');
            }
        });
    });
});
</script>

@stop