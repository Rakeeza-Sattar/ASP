
@extends('layouts.app')

@section('title', 'My Reports')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">My Reports</h1>
                    <p class="mb-0 text-muted">Download your security audit reports</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    @if($reports->count() > 0)
                        @foreach($reports as $report)
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-{{ $report->type == 'audit' ? 'success' : 'danger' }} rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-{{ $report->type == 'audit' ? 'clipboard-check' : 'exclamation-triangle' }} text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">{{ ucfirst($report->type) }} Report</h5>
                                <p class="mb-1 text-muted">{{ $report->appointment->home->address }}</p>
                                <small class="text-info">Generated: {{ $report->created_at->format('M d, Y') }}</small>
                                @if($report->generatedBy)
                                    <br><small class="text-success">By: {{ $report->generatedBy->name }}</small>
                                @endif
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ route('homeowner.reports.show', $report) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('homeowner.reports.download', $report) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $reports->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-4x text-gray-300 mb-4"></i>
                            <h4 class="text-gray-500">No Reports Available</h4>
                            <p class="text-muted">Reports will be generated after your security audits are completed.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
