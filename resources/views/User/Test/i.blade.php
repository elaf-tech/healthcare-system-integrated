@extends('User.master')
<base href="/public">
@section('content')
<div class="medical-app">
    <div class="app-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <!-- Header Section -->
        <div class="app-header">
            <div class="header-overlay"></div>
            <div class="header-content">
                <div class="header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgba(255,255,255,0.2)">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                        <path d="M7 12h2v5H7zm4-7h2v12h-2zm4 4h2v8h-2z"/>
                    </svg>
                </div>
                <h1>  {{__('web.testRecord')}}</h1>
                <p > {{__('web.viewTest')}}</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="app-body">
            <!-- Add New Test Button -->
            <div class="action-bar">
                <a href="{{ route('test.create', ['user_id' => auth()->user()->id]) }}" class="add-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    <span>{{__('web.addYourInfo')}}</span>
                </a>
            </div>

            @if($tests->isEmpty())
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                            <path d="M12 7c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-4 5c0-.55.45-1 1-1h6c.55 0 1 .45 1 1v1c0 1.1-.9 2-2 2h-4c-1.1 0-2-.9-2-2v-1z"/>
                        </svg>
                    </div>
                    <h3>لا توجد تحاليل مسجلة</h3>
                    <p>لم يتم تسجيل أي تحاليل طبية حتى الآن</p>
                    <a href="{{ route('test.create') }}" class="primary-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        إضافة تحليل جديد
                    </a>
                </div>
            @else
                <!-- Tests Table -->
                <div class="data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zm1-11h-2v3H8v2h3v3h2v-3h3v-2h-3V8z"/>
                                    </svg>
                                    <span>{{ __('web.testType') }}</span>
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/>
                                    </svg>
                                    <span>{{ __('web.testDate') }}</span>
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                                        <path d="M7 12h2v5H7zm4-7h2v12h-2zm4 4h2v8h-2z"/>
                                    </svg>
                                    <span>{{ __('web.resultValue') }}</span>
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zm1-11h-2v3H8v2h3v3h2v-3h3v-2h-3V8z"/>
                                    </svg>
                                    <span>{{ __('web.unit') }}</span>
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                        <path d="M8 12h8v1H8zm0 3h8v1H8zm0 3h5v1H8z"/>
                                    </svg>
                                    <span>{{ __('web.notes') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tests as $test)
                            <tr>
                                <td>
                                    <div class="cell-content">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zm1-11h-2v3H8v2h3v3h2v-3h3v-2h-3V8z"/>
                                        </svg>
                                        <span>{{ $test->test_type }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-content">
                                        <span class="date">{{ \Carbon\Carbon::parse($test->test_date)->format('Y-m-d') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-content result-value {{ $test->result_value < 50 ? 'low' : ($test->result_value > 150 ? 'high' : 'normal') }}">
                                        <span>{{ $test->result_value }}</span>
                                        @if($test->unit)
                                        <span class="unit">{{ $test->unit }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-content">
                                        <span>{{ $test->unit ?: '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-content notes" title="{{ $test->notes ?: 'لا توجد ملاحظات' }}">
                                        <span>{{ $test->notes ?: 'لا توجد ملاحظات' }}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
:root {
    --primary-dark: #2c3e50;
    --primary-light: #3498db;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f5f7fa;
    --border-color: #e0e6ed;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    line-height: 1.6;
    color: var(--text-dark);
    background-color: var(--bg-light);
}

.medical-app {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.app-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(41, 72, 94, 0.1);
    overflow: hidden;
}

/* Header Styles */
.app-header {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
    color: white;
    padding: 30px;
    position: relative;
    text-align: center;
}

.header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.6;
}

.header-content {
    position: relative;
    z-index: 2;
}

.header-icon svg {
    width: 60px;
    height: 60px;
    margin-bottom: 15px;
}

.app-header h1 {
    font-size: 28px;
    margin-bottom: 8px;
    font-weight: 700;
}

.app-header p {
    opacity: 0.9;
    font-size: 16px;
    max-width: 600px;
    margin: 0 auto;
}

/* App Body */
.app-body {
    padding: 25px;
}

/* Action Bar */
.action-bar {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 25px;
}

.add-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
    color: white;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(44, 62, 80, 0.2);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    font-size: 16px;
}

.add-btn svg {
    width: 18px;
    height: 18px;
    margin-left: 8px;
    fill: currentColor;
}

.add-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
}

.add-btn:active {
    transform: translateY(1px);
}

/* Data Table */
.data-table {
    width: 100%;
    overflow-x: auto;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.data-table table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 14px;
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

.data-table thead th {
    background-color: var(--primary-dark);
    color: white;
    font-weight: 600;
    padding: 16px 20px;
    text-align: right;
    position: sticky;
    top: 0;
    transition: all 0.3s;
}

.data-table thead th:hover {
    background-color: #243342;
}

.data-table thead th svg {
    width: 16px;
    height: 16px;
    margin-left: 8px;
    fill: currentColor;
    opacity: 0.8;
}

.data-table tbody tr {
    transition: all 0.2s;
}

.data-table tbody tr:nth-child(even) {
    background-color: rgba(52, 152, 219, 0.03);
}

.data-table tbody tr:hover {
    background-color: rgba(52, 152, 219, 0.1);
}

.data-table tbody td {
    padding: 14px 20px;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}

/* Cell Content */
.cell-content {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.cell-content svg {
    width: 16px;
    height: 16px;
    margin-left: 8px;
    fill: var(--primary-light);
    opacity: 0.7;
}

.date {
    color: var(--text-light);
    font-size: 13px;
}

/* Result Value Styles */
.result-value {
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
}

.result-value.normal {
    background-color: rgba(46, 204, 113, 0.1);
    color: var(--success-color);
}

.result-value.high {
    background-color: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
}

.result-value.low {
    background-color: rgba(243, 156, 18, 0.1);
    color: var(--warning-color);
}

.unit {
    font-size: 12px;
    color: var(--text-light);
    margin-right: 5px;
}

/* Notes */
.notes {
    max-width: 300px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
    transition: all 0.3s;
}

.notes:hover {
    color: var(--primary-light);
}

/* Empty State */
.empty-state {
    padding: 50px 20px;
    text-align: center;
    color: var(--text-light);
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.empty-icon svg {
    width: 80px;
    height: 80px;
    margin-bottom: 20px;
    fill: #e0e6ed;
}

.empty-state h3 {
    font-size: 22px;
    margin-bottom: 10px;
    color: var(--text-dark);
}

.empty-state p {
    margin-bottom: 25px;
    font-size: 16px;
}

.primary-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 28px;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
    color: white;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(44, 62, 80, 0.2);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.primary-btn svg {
    width: 18px;
    height: 18px;
    margin-left: 8px;
    fill: currentColor;
}

.primary-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
    color: white;
}

/* Responsive Design */
@media (max-width: 992px) {
    .app-body {
        padding: 20px;
    }
    
    .data-table thead th {
        padding: 14px 16px;
    }
    
    .data-table tbody td {
        padding: 12px 16px;
    }
}

@media (max-width: 768px) {
    .medical-app {
        padding: 15px;
    }
    
    .app-header {
        padding: 25px 20px;
    }
    
    .app-header h1 {
        font-size: 24px;
    }
    
    .app-header p {
        font-size: 15px;
    }
    
    .header-icon svg {
        width: 50px;
        height: 50px;
    }
    
    .empty-icon svg {
        width: 60px;
        height: 60px;
    }
    
    .empty-state h3 {
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .app-header h1 {
        font-size: 22px;
    }
    
    .app-header p {
        font-size: 14px;
    }
    
    .add-btn, .primary-btn {
        padding: 10px 20px;
        font-size: 15px;
    }
    
    .empty-state {
        padding: 40px 15px;
    }
    
    .empty-state h3 {
        font-size: 18px;
    }
    
    .empty-state p {
        font-size: 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Expand notes on click
    document.querySelectorAll('.notes').forEach(note => {
        note.addEventListener('click', function() {
            this.style.whiteSpace = this.style.whiteSpace === 'nowrap' ? 'normal' : 'nowrap';
            this.style.maxWidth = this.style.maxWidth === 'none' ? '300px' : 'none';
        });
    });
    
    // Add animation to table rows
    document.querySelectorAll('.data-table tbody tr').forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(20px)';
        row.style.transition = `all 0.4s ease ${index * 0.05}s`;
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, 100);
    });
});
</script>

@endsection