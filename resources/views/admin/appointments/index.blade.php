@extends('layouts.admin')

@section('title', 'Appointments Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Appointments Management</h4>
                    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Appointment
                    </a>
                </div>
                
                <div class="card-body">
                    {{ $dataTable->table(['class' => 'table table-striped table-hover']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
function deleteAppointment(id) {
    if (confirm('Are you sure you want to delete this appointment?')) {
        $.ajax({
            url: '/admin/appointments/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#appointments-table').DataTable().ajax.reload();
                toastr.success('Appointment deleted successfully');
            },
            error: function(xhr) {
                toastr.error('Error deleting appointment');
            }
        });
    }
}
</script>
@endpush

// resources/views/admin/users/index.blade.php
@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Users Management</h4>
                </div>
                
                <div class="card-body">
                    {{ $dataTable->table(['class' => 'table table-striped table-hover']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: '/admin/users/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#users-table').DataTable().ajax.reload();
                toastr.success('User deleted successfully');
            },
            error: function(xhr) {
                toastr.error('Error deleting user');
            }
        });
    }
}
</script>
@endpush