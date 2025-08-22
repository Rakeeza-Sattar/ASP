
@extends('layouts.app')

@section('title', 'My Appointments')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">My Appointments</h1>
                    <p class="mb-0 text-muted">Track your security audit appointments</p>
                </div>
                <a href="{{ route('homeowner.appointments.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Schedule New Audit
                </a>
            </div>
        </div>
    </div>

    <!-- Appointments List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    @if($appointments->count() > 0)
                        @foreach($appointments as $appointment)
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'in_progress' ? 'warning' : 'primary') }} rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-{{ $appointment->status == 'completed' ? 'check' : ($appointment->status == 'in_progress' ? 'clock' : 'calendar') }} text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Security Audit</h5>
                                <p class="mb-1 text-muted">{{ $appointment->home->address }}</p>
                                <small class="text-info">
                                    {{ $appointment->scheduled_date->format('M d, Y') }} at {{ $appointment->scheduled_time }}
                                </small>
                                @if($appointment->officer)
                                    <br><small class="text-success">Officer: {{ $appointment->officer->name }}</small>
                                @endif
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'in_progress' ? 'warning' : 'primary') }} me-2">
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                                <a href="{{ route('homeowner.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">
                                    View Details
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
                            <i class="fas fa-calendar-plus fa-4x text-gray-300 mb-4"></i>
                            <h4 class="text-gray-500">No Appointments Yet</h4>
                            <p class="text-muted">Schedule your first security audit to get started.</p>
                            <a href="{{ route('homeowner.appointments.create') }}" class="btn btn-primary">
                                Schedule Now
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
