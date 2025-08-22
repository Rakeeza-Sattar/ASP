
@extends('layouts.app')

@section('title', 'Officer Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Officer Dashboard</h1>
                    <p class="mb-0 text-muted">Welcome back, {{ auth()->user()->name }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('officer.appointments.index') }}" class="btn btn-primary">
                        <i class="fas fa-calendar"></i> My Assignments
                    </a>
                    <button class="btn btn-outline-secondary" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Assignments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_assignments']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Today's Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['today_appointments']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed Audits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['completed_assignments']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Homes Visited</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_homes_visited']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Today's Schedule -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Today's Schedule</h6>
                    <span class="badge bg-info">{{ Carbon\Carbon::now()->format('M d, Y') }}</span>
                </div>
                <div class="card-body">
                    @if($todayAppointments->count() > 0)
                        @foreach($todayAppointments as $appointment)
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-{{ $appointment->status == 'scheduled' ? 'warning' : ($appointment->status == 'in_progress' ? 'info' : 'success') }} rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-{{ $appointment->status == 'scheduled' ? 'clock' : ($appointment->status == 'in_progress' ? 'play' : 'check') }} text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">{{ $appointment->home->owner->name }}</h6>
                                <small class="text-muted">{{ $appointment->home->address }}</small>
                                <br><small class="text-info">{{ $appointment->scheduled_time }}</small>
                            </div>
                            <div class="flex-shrink-0">
                                @if($appointment->status == 'scheduled')
                                    <button class="btn btn-sm btn-success me-1" onclick="startAppointment({{ $appointment->id }})">
                                        <i class="fas fa-play"></i> Start
                                    </button>
                                @elseif($appointment->status == 'in_progress')
                                    <a href="{{ route('officer.appointments.document', $appointment) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-clipboard"></i> Document
                                    </a>
                                @endif
                                <a href="{{ route('officer.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-check fa-3x text-gray-300 mb-3"></i>
                            <p class="text-muted">No appointments scheduled for today</p>
                            <small class="text-muted">Take some time to prepare for upcoming assignments!</small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                    <a href="{{ route('officer.appointments.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentAppointments->count() > 0)
                        @foreach($recentAppointments as $appointment)
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-{{ $appointment->status == 'completed' ? 'success' : 'warning' }} rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-{{ $appointment->status == 'completed' ? 'check' : 'clock' }} text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Security Audit</h6>
                                <small class="text-muted">{{ $appointment->home->address }}</small>
                                <br><small class="text-info">{{ $appointment->scheduled_date->format('M d, Y') }}</small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'in_progress' ? 'info' : 'warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-clipboard-list fa-3x text-gray-300 mb-3"></i>
                            <p class="text-muted">No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-5">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('officer.appointments.index') }}" class="btn btn-primary">
                            <i class="fas fa-calendar me-2"></i>View All Assignments
                        </a>
                        <button class="btn btn-outline-secondary" onclick="markAvailable()">
                            <i class="fas fa-user-check me-2"></i>Mark Available
                        </button>
                        <button class="btn btn-outline-warning" onclick="reportIssue()">
                            <i class="fas fa-exclamation-triangle me-2"></i>Report Issue
                        </button>
                    </div>
                </div>
            </div>

            <!-- Upcoming Assignments -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upcoming Assignments</h6>
                </div>
                <div class="card-body">
                    @if($upcomingAppointments->count() > 0)
                        @foreach($upcomingAppointments->take(3) as $appointment)
                        <div class="d-flex align-items-center py-2 border-bottom">
                            <div class="flex-grow-1">
                                <h6 class="mb-1 small">{{ $appointment->home->owner->name }}</h6>
                                <small class="text-muted">{{ $appointment->scheduled_date->format('M d') }} at {{ $appointment->scheduled_time }}</small>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ route('officer.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @if($upcomingAppointments->count() > 3)
                        <div class="text-center mt-3">
                            <a href="{{ route('officer.appointments.index') }}" class="btn btn-sm btn-link">
                                View {{ $upcomingAppointments->count() - 3 }} more...
                            </a>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-plus fa-2x text-gray-300 mb-2"></i>
                            <p class="text-muted small">No upcoming assignments</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Performance Overview -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Performance Overview</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Items Documented:</span>
                            <strong>{{ $stats['total_items_documented'] }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Reports Generated:</span>
                            <strong>{{ $stats['total_reports_generated'] }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Completion Rate:</span>
                            <strong>
                                @if($stats['total_assignments'] > 0)
                                    {{ round(($stats['completed_assignments'] / $stats['total_assignments']) * 100) }}%
                                @else
                                    0%
                                @endif
                            </strong>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <small class="text-muted">Current Month Performance</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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

function markAvailable() {
    toastr.info('Availability feature will be implemented soon!');
}

function reportIssue() {
    toastr.info('Issue reporting feature will be implemented soon!');
}

function refreshDashboard() {
    window.location.reload();
}
</script>
@endpush

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
</style>
@endpush
