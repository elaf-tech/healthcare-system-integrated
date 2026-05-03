@extends('User.master')
<base href="/public">
@section('content')
<div class="appointments-container">
    <div class="appointments-card">
        <!-- Header Section -->
        <div class="appointments-header" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <div class="header-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h2>{{__('web.myAppointments')}}</h2>
            <p> {{__('web.appointmentsList')}}</p>
        </div>

        <!-- Appointments Table -->
        <div class="appointments-content" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            @if($appointments->count() > 0)
                <div class="table-container">
                    <table class="appointments-table"  dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('web.patient')}}</th>
                                @if(auth()->user()->role == 1)

                                <th>{{__('web.patientData')}}</th>
                                <th>{{__('web.patientTests')}}</th>
                                @endif
                                <th> {{__('web.day')}}</th>
                                <th>{{__('web.appointmentTime')}}</th>
                                <th>{{__('web.appointmentStatus')}}</th>
                                <th>{{__('web.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $index => $appointment)
                            <tr class="{{ $appointment->status == 'confirmed' ? 'confirmed' : ($appointment->status == 'web.cancelled' ? 'web.cancelled' : 'web.pending') }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="doctor-info">
                                        {{-- <img src="{{ asset($appointment->doctor->image ?? 'images/default-doctor.png') }}" alt="صورة الطبيب" class="doctor-image"> --}}
                                        {{-- <img src="{{ asset('storage/' . $appointment->doctor->image) }}" alt="{{ $appointment->doctor->name}}" class="doctor-image"> --}}

                                        <span>{{ $appointment->patient->full_name }}</span>
                                    </div>
                                </td>
                                @if(auth()->user()->role == 1)

                                <td><a href="{{route('appointment.showInfo',$appointment->patient->id )}}">{{__('web.viewPatientInfo')}}</a></td>
                                <td><a href="{{route('test.show',$appointment->patient->id )}}">{{__('web.viewPatientTests')}}</a></td>
@endif
                                <td>{{ ($appointment->day) }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                                <td>
                                    

                                    <span class="status-badge status-{{ $appointment->status }}">
                                        @if($appointment->status == 'confirmed')
                                            {{__('web.confirmed')}}  
                                            @elseif($appointment->status == 'pending')
                                            {{__('web.pending')}}                                        
                                             @elseif($appointment->status == 'completed')
                                            {{__('web.completed')}}                                        
                                            @else
                                        {{__('web.cancelled')}}                                        @endif
                                    </span>
                                   
                                </td>
                                <td>
                                    <div class="actions">
                                        @if(auth()->user()->role == 1)
                                        @if($appointment->status == 'pending')
                                            <!-- زر تأكيد الحجز -->
                                            <a href="{{ route('appointment.confirm', $appointment->id) }}" type="button" 
                                                class="action-btn confirm-btn" 
                                                title="تأكيد الموعد">
                                                <i class="fas fa-check"></i> {{__('web.appointmentConfirm')}}
                                            </a>
                                
                                            <!-- زر إلغاء الحجز -->
                                            {{-- <a href="{{ route('appointment.cancel', $appointment->id) }}" type="button" 
                                                class="action-btn cancel-btn" 
                                                title="إلغاء الموعد"
                                                onclick="showCancelConfirmation({{ $appointment->id }})">
                                                <i class="fas fa-times"></i>
                                            </a> --}}
                                        @endif
                                        @endif

                                        @if(auth()->user()->role == 1)
                                        @if($appointment->status == 'confirmed')
                                            <!-- زر تأكيد الحجز -->
                                            <a href="{{ route('appointment.completed', $appointment->id) }}" type="button" 
                                                class="action-btn confirm-btn" 
                                                title="تأكيد الموعد">
                                                <i class="fas fa-check"></i> {{__('web.completed')}}
                                            </a>
                                
                                            <!-- زر إلغاء الحجز -->
                                            {{-- <a href="{{ route('appointment.cancel', $appointment->id) }}" type="button" 
                                                class="action-btn cancel-btn" 
                                                title="إلغاء الموعد"
                                                onclick="showCancelConfirmation({{ $appointment->id }})">
                                                <i class="fas fa-times"></i>
                                            </a> --}}
                                        @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <h3>{{__('web.noAppointments')}}</h3>
                   <p>{{__('web.noAppointmentsMessage')}}</p>
                    <a href="{{ route('doctors.index') }}" class="btn btn-primary">
                        <i class="fas fa-search"></i> {{__('web.searchDoctor')}}
                    </a>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($appointments->hasPages())
        <div class="appointments-pagination">
            {{ $appointments->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Cancel Appointment Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الإلغاء</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من رغبتك في إلغاء هذا الموعد؟</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                <button type="button" class="btn btn-danger" id="confirmCancel">نعم، ألغِ الموعد</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.appointments-container {
    font-family: 'Tajawal', sans-serif;
    padding: 30px;
    background: #f5f7fa;
    min-height: 100vh;
}

.appointments-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

/* Header Styles */
.appointments-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 30px;
    text-align: center;
    position: relative;
}

.appointments-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.header-icon {
    font-size: 50px;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.2);
}

.appointments-header h2 {
    font-size: 28px;
    margin-bottom: 10px;
    font-weight: 700;
}

.appointments-header p {
    opacity: 0.9;
    margin-bottom: 0;
    font-size: 16px;
}

/* Table Styles */
.table-container {
    padding: 20px;
    overflow-x: auto;
}

.appointments-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.appointments-table thead th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    padding: 15px;
    text-align: right;
    border-bottom: 2px solid #e9ecef;
}

.appointments-table tbody tr {
    transition: all 0.3s;
    border-radius: 10px;
    overflow: hidden;
}

.appointments-table tbody tr:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.appointments-table tbody td {
    padding: 15px;
    background-color: white;
    border-top: 1px solid #f1f1f1;
    border-bottom: 1px solid #f1f1f1;
}

.appointments-table tbody td:first-child {
    border-right: 1px solid #f1f1f1;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.appointments-table tbody td:last-child {
    border-left: 1px solid #f1f1f1;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
}

.status-confirmed {
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.status-pending {
    background-color: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.status-cancelled {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

/* Doctor Info */
.doctor-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.doctor-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e9ecef;
}

/* Action Buttons */
.actions {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.action-btn:hover {
    transform: scale(1.1);
}

.cancel-btn {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.cancel-btn:hover {
    background-color: rgba(220, 53, 69, 0.2);
}

.details-btn {
    background-color: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}

.details-btn:hover {
    background-color: rgba(13, 110, 253, 0.2);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 50px 20px;
}

.empty-state i {
    font-size: 60px;
    color: #adb5bd;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: #495057;
    margin-bottom: 10px;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 20px;
}

/* Pagination */
.appointments-pagination {
    padding: 20px;
    display: flex;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .appointments-header {
        padding: 20px;
    }
    
    .appointments-header h2 {
        font-size: 24px;
    }
    
    .appointments-table thead {
        display: none;
    }
    
    .appointments-table tbody tr {
        display: block;
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .appointments-table tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        border: none;
        border-radius: 0 !important;
    }
    
    .appointments-table tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #495057;
    }
    
    .appointments-table tbody td:first-child {
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }
    
    .appointments-table tbody td:last-child {
        border-bottom-left-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
    }
    
    .doctor-info {
        justify-content: space-between;
        width: 100%;
    }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showCancelConfirmation(appointmentId) {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "لن تتمكن من التراجع عن هذا الإجراء!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، ألغِ الموعد',
            cancelButtonText: 'تراجع',
            customClass: {
                confirmButton: 'btn btn-danger mx-2',
                cancelButton: 'btn btn-secondary mx-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`cancelForm-${appointmentId}`).submit();
            }
        });
    }
</script>
<script>
     function confirmCancel() {
        return confirm('هل أنت متأكد أنك تريد إلغاء هذا الموعد؟');
    }

$(document).ready(function() {
    // Cancel Appointment
    $('.cancel-btn').click(function() {
        const appointmentId = $(this).data('id');
        $('#confirmCancel').data('id', appointmentId);
        $('#cancelModal').modal('show');
    });

    $('#confirmCancel').click(function() {
        const appointmentId = $(this).data('id');
        
        $.ajax({
            url: `/appointments/${appointmentId}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('حدث خطأ أثناء محاولة الإلغاء');
                $('#cancelModal').modal('hide');
            }
        });
    });
});
</script>
<script>
    function confirmCancel() {
        return confirm('هل أنت متأكد أنك تريد إلغاء هذا الموعد؟');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection