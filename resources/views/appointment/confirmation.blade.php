@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h2>✅ Appointment Confirmed!</h2>
                    <p class="mb-0">Thank you, {{ $appointment->home->owner->first_name }}. Your free home audit is booked.</p>
                </div>
                
                <div class="card-body p-4">
                    <!-- Appointment Details -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                                    <h4>{{ $appointment->scheduled_at->format('M j, Y') }}</h4>
                                    <p class="mb-0">{{ $appointment->scheduled_at->format('g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <i class="fas fa-home fa-2x mb-3"></i>
                                    <h6>Service Address:</h6>
                                    <p class="mb-0">{{ $appointment->home->full_address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Instructions -->
                    <div class="card border-success mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Please gather the following before your appointment:</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Receipts for major valuables</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Electronics (TVs, computers, phones)</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Jewelry and watches</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Appliances and furniture</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Artwork and collectibles</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Warranty papers</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Appraisal documents</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Any other valuable items</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- What to Expect -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>What to Expect:</h6>
                        <p class="mb-0">Your licensed officer will arrive in uniform, verify ID, and complete your audit. 
                        The process typically takes 1-2 hours depending on the number of items to document.</p>
                    </div>
                    
                    <!-- Optional Add-on -->
                    <div class="card border-warning mb-4">
                        <div class="card-body text-center">
                            <h5 class="text-warning">🛡️ Want to protect your home deed from fraud?</h5>
                            <p>Add Title Protection today for just <strong>$50/month</strong></p>
                            <a href="{{ route('payment.form') }}?addon=title_protection" class="btn btn-warning">
                                Add Title Protection Now
                            </a>
                        </div>
                    </div>
                    
                    <!-- Next Steps -->
                    <div class="text-center">
                        <h5>Next Steps:</h5>
                        <div class="d-grid gap-2 d-md-block">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-user me-2"></i>Access Your Account
                            </a>
                            <a href="{{ route('payment.form') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Complete Payment
                            </a>
                        </div>
                        
                        <p class="mt-3 text-muted">
                            <small>Need to reschedule? Call us at <strong>(555) 123-4567</strong></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection