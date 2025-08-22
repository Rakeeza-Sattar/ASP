
@extends('layouts.app')

@section('title', 'My Assignments')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">My Assignments</h1>
                    <p class="mb-0 text-muted">Track your scheduled security audits</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Assignments List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    @if($appointments->count() > 0)
                        @foreach($appointments as $appointment)
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'in_progress' ? 'warning' : 'primary') }} rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-{{ $appointment->status == 'completed' ? 'check' : ($appointment->status == 'in_progress' ? 'play' : 'calendar') }} text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Security Audit</h5>
                                <p class="mb-1"><strong>{{ $appointment->home->owner->name }}</strong></p>
                                <p class="mb-1 text-muted">{{ $appointment->home->address }}</p>
                                <small class="text-info">
                                    {{ $appointment->scheduled_date->format('M d, Y') }} at {{ $appointment->scheduled_time }}
                                </small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'in_progress' ? 'warning' : 'primary') }} me-2">
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                                @if($appointment->status == 'scheduled')
                                    <button class="btn btn-sm btn-success me-1" onclick="startAppointment({{ $appointment->id }})">
                                        <i class="fas fa-play"></i> Start
                                    </button>
                                @elseif($appointment->status == 'in_progress')
                                    <a href="{{ route('officer.appointments.document', $appointment) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-clipboard"></i> Document
                                    </a>
                                @endif
                                <a href="{{ route('officer.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Details
                                </a>
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-check fa-4x text-gray-300 mb-4"></i>
                            <h4 class="text-gray-500">No Assignments Yet</h4>
                            <p class="text-muted">Your assigned appointments will appear here.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function startAppointment(appointmentId) {
    if (confirm('Are you ready to start this appointment?')) {
        $.ajax({
            url: `/officer/appointments/${appointmentId}/start`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                toastr.success('Appointment started successfully');
                window.location.reload();
            },
            error: function(xhr) {
                toastr.error('Error starting appointment');
            }
        });
    }
}
</script>
@endpush
@endsection
