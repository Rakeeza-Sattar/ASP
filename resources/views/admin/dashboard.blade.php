
@extends('layouts.admin')

@section('title', 'Admin Dashboard - Security Audit System')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <p class="mb-0 text-muted">Security Audit System Overview</p>
                </div>
                <div>
                    <span class="text-muted">Last updated: {{ now()->format('M d, Y H:i') }}</span>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_users']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters mt-2">
                        <div class="col">
                            <small class="text-muted">
                                Homeowners: {{ $stats['total_homeowners'] }} | Officers: {{ $stats['total_officers'] }}
                            </small>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Revenue (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($stats['monthly_revenue'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters mt-2">
                        <div class="col">
                            <small class="text-muted">
                                Total: ${{ number_format($stats['total_revenue'], 2) }}
                            </small>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_appointments']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters mt-2">
                        <div class="col">
                            <small class="text-muted">
                                Pending: {{ $stats['pending_appointments'] }} | Completed: {{ $stats['completed_appointments'] }}
                            </small>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Reports</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_reports']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters mt-2">
                        <div class="col">
                            <small class="text-muted">
                                Audit: {{ $stats['audit_reports'] }} | Incident: {{ $stats['incident_reports'] }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Items Catalogued</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_items']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Title Monitoring</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['active_title_monitoring']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shield-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters mt-2">
                        <div class="col">
                            <small class="text-muted">Active Subscriptions</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">In Progress</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['in_progress_appointments']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters mt-2">
                        <div class="col">
                            <small class="text-muted">Appointments Currently Active</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Upcoming Appointments -->
        <div class="col-xl-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Upcoming Appointments (Next 7 Days)</h6>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($upcomingAppointments->count() > 0)
                        @foreach($upcomingAppointments as $appointment)
                            <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                <div class="mr-3">
                                    <div class="text-xs text-muted">{{ $appointment->appointment_date->format('M d') }}</div>
                                    <div class="text-xs text-muted">{{ $appointment->appointment_time }}</div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="font-weight-bold">{{ $appointment->home->owner->name }}</div>
                                    <div class="text-sm text-muted">{{ Str::limit($appointment->home->address, 40) }}</div>
                                    @if($appointment->officer)
                                        <div class="text-xs text-success">Officer: {{ $appointment->officer->name }}</div>
                                    @else
                                        <div class="text-xs text-warning">No officer assigned</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="badge badge-{{ $appointment->status === 'scheduled' ? 'primary' : 'secondary' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>No upcoming appointments in the next 7 days</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-xl-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3">Recent Appointments</h6>
                            @foreach($recentAppointments->take(5) as $appointment)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="mr-3">
                                        <i class="fas fa-calendar text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="font-weight-bold text-sm">{{ $appointment->home->owner->name }}</div>
                                        <div class="text-xs text-muted">{{ $appointment->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div>
                                        <span class="badge badge-sm badge-{{ $appointment->status === 'completed' ? 'success' : ($appointment->status === 'scheduled' ? 'primary' : 'warning') }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3">Recent Payments</h6>
                            @foreach($recentPayments->take(5) as $payment)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="mr-3">
                                        <i class="fas fa-dollar-sign text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="font-weight-bold text-sm">${{ number_format($payment->amount, 2) }}</div>
                                        <div class="text-xs text-muted">{{ $payment->user->name }} • {{ $payment->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-plus fa-sm"></i> Schedule Appointment
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-block">
                                <i class="fas fa-user-plus fa-sm"></i> Add New User
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-info btn-block">
                                <i class="fas fa-file-alt fa-sm"></i> View Reports
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.payments.index') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-credit-card fa-sm"></i> Manage Payments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.border-left-secondary {
    border-left: 0.25rem solid #858796 !important;
}
.border-left-dark {
    border-left: 0.25rem solid #5a5c69 !important;
}
.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}
</style>
@endpush
