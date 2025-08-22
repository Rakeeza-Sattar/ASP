
@extends('layouts.admin')

@section('title', 'Appointments Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Appointments Management</h1>
                    <p class="mb-0 text-muted">Schedule, assign, and track security audits</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Schedule New Appointment
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?status=scheduled">Scheduled</a>
                            <a class="dropdown-item" href="?status=in_progress">In Progress</a>
                            <a class="dropdown-item" href="?status=completed">Completed</a>
                            <a class="dropdown-item" href="?status=cancelled">Cancelled</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.appointments.index') }}">All Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Scheduled</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="scheduled-count">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">In Progress</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="progress-count">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="completed-count">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Unassigned</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="unassigned-count">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Data Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">All Appointments</h6>
                        <div class="d-flex align-items-center">
                            <div class="form-group mb-0 mr-3">
                                <select class="form-control form-control-sm" id="bulk-action" style="width: auto;">
                                    <option value="">Bulk Actions</option>
                                    <option value="assign-officer">Assign Officer</option>
                                    <option value="change-status">Change Status</option>
                                    <option value="export">Export Selected</option>
                                </select>
                            </div>
                            <button class="btn btn-sm btn-outline-primary" onclick="refreshTable()">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-striped table-hover', 'id' => 'appointments-table']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Officer Assignment Modal -->
<div class="modal fade" id="assignOfficerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Officer</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="assignOfficerForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="officer_id">Select Officer</label>
                        <select class="form-control" id="officer_id" name="officer_id" required>
                            <option value="">Choose an officer...</option>
                            <!-- Officers will be loaded via AJAX -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Assignment Notes (Optional)</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" 
                                  placeholder="Any special instructions or notes for the officer..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Officer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
let selectedAppointmentId = null;

function assignOfficer(appointmentId) {
    selectedAppointmentId = appointmentId;
    
    // Load available officers
    $.get('/admin/officers/available', function(officers) {
        const select = $('#officer_id');
        select.empty().append('<option value="">Choose an officer...</option>');
        
        officers.forEach(function(officer) {
            select.append(`<option value="${officer.id}">${officer.name} - ${officer.license_number || 'No License'}</option>`);
        });
    });
    
    $('#assignOfficerModal').modal('show');
}

function deleteAppointment(id) {
    if (confirm('Are you sure you want to delete this appointment? This action cannot be undone.')) {
        $.ajax({
            url: `/admin/appointments/${id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#appointments-table').DataTable().ajax.reload();
                toastr.success('Appointment deleted successfully');
                updateStats();
            },
            error: function(xhr) {
                toastr.error('Error deleting appointment: ' + xhr.responseJSON.message);
            }
        });
    }
}

function changeStatus(appointmentId, newStatus) {
    $.ajax({
        url: `/admin/appointments/${appointmentId}/status`,
        type: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { status: newStatus },
        success: function(response) {
            $('#appointments-table').DataTable().ajax.reload();
            toastr.success('Status updated successfully');
            updateStats();
        },
        error: function(xhr) {
            toastr.error('Error updating status');
        }
    });
}

function refreshTable() {
    $('#appointments-table').DataTable().ajax.reload();
    updateStats();
}

function updateStats() {
    $.get('/admin/appointments/stats', function(stats) {
        $('#scheduled-count').text(stats.scheduled || 0);
        $('#progress-count').text(stats.in_progress || 0);
        $('#completed-count').text(stats.completed || 0);
        $('#unassigned-count').text(stats.unassigned || 0);
    });
}

// Handle officer assignment form submission
$('#assignOfficerForm').on('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    $.ajax({
        url: `/admin/appointments/${selectedAppointmentId}/assign`,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#assignOfficerModal').modal('hide');
            $('#appointments-table').DataTable().ajax.reload();
            toastr.success('Officer assigned successfully');
            updateStats();
        },
        error: function(xhr) {
            toastr.error('Error assigning officer: ' + xhr.responseJSON.message);
        }
    });
});

// Load initial stats
$(document).ready(function() {
    updateStats();
});

// Auto-refresh every 5 minutes
setInterval(function() {
    updateStats();
}, 300000);
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
.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}

.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.85rem;
    color: #5a5c69;
    background-color: #f8f9fc;
}

.badge {
    font-size: 0.75rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
</style>
@endpush
