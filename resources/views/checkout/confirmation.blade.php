@extends('layouts.app')

@section('title', 'Appointment Confirmed - Alpha Security Bureau')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Progress Indicator -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="step-indicator completed">
                        <div class="step-circle">✓</div>
                        <span>Appointment Details</span>
                    </div>
                    <div class="step-line completed"></div>
                    <div class="step-indicator active">
                        <div class="step-circle">✓</div>
                        <span>Confirmation</span>
                    </div>
                </div>
            </div>

            <!-- Confirmation Card -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center py-4">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h3 class="mb-0">🎉 Appointment Confirmed!</h3>
                    <p class="mb-0">Your free home security audit has been scheduled</p>
                </div>

                <div class="card-body p-5">
                    <!-- Appointment Details -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="appointment-detail">
                                <h6 class="text-primary">📅 Appointment Date</h6>
                                <p class="h5">{{ $appointment->scheduled_at->format('l, F j, Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="appointment-detail">
                                <h6 class="text-primary">🕐 Time</h6>
                                <p class="h5">{{ $appointment->scheduled_at->format('g:i A') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="appointment-detail">
                                <h6 class="text-primary">🏠 Property Address</h6>
                                <p>{{ $appointment->home->full_address }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="appointment-detail">
                                <h6 class="text-primary">👤 Homeowner</h6>
                                <p>{{ $appointment->home->owner->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmation Email Notice -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-envelope me-2"></i>Confirmation Email Sent</h6>
                        <p class="mb-0">We've sent a confirmation email to <strong>{{ $appointment->home->owner->email }}</strong> 
                        with all your appointment details and a calendar invite.</p>
                    </div>

                    <!-- Preparation Instructions -->
                    <div class="card border-warning mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>How to Prepare for Your Audit</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary">📋 Documents to Gather:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Purchase receipts for valuable items</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Jewelry appraisal certificates</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Electronics warranties</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Art/collectible documentation</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Insurance policies (current)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary">🏠 Items to Document:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Jewelry & watches</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Electronics & appliances</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Furniture & antiques</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Artwork & collectibles</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Tools & equipment</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- What to Expect -->
                    <div class="card border-info mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>What to Expect During Your Visit</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker">1</div>
                                    <div class="timeline-content">
                                        <h6>Officer Arrival & ID Verification</h6>
                                        <p>Our licensed officer will arrive in uniform with proper identification and credentials.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker">2</div>
                                    <div class="timeline-content">
                                        <h6>Initial Consultation (15 minutes)</h6>
                                        <p>Review of your valuable items and documentation needs.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker">3</div>
                                    <div class="timeline-content">
                                        <h6>Professional Documentation (60-90 minutes)</h6>
                                        <p>Systematic photographing and cataloging of your valuable items.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker">4</div>
                                    <div class="timeline-content">
                                        <h6>Report Generation & Review</h6>
                                        <p>Completion of your comprehensive asset documentation report.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Optional Add-on -->
                    <div class="card border-warning mb-4">
                        <div class="card-body text-center">
                            <h5 class="text-warning">🛡️ Protect Your Home Deed from Fraud</h5>
                            <p>Add Title Protection monitoring for just <strong>$50/month</strong> and get alerts 
                            if anyone tries to file fraudulent documents against your property.</p>
                            <a href="{{ route('payment.form') }}?addon=title_protection" class="btn btn-warning">
                                Add Title Protection Now
                            </a>
                        </div>
                    </div>

                    <!-- Important Reminders -->
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Important Reminders</h6>
                        <ul class="mb-0">
                            <li>Please be present during the entire appointment</li>
                            <li>Have your photo ID ready for verification</li>
                            <li>Keep pets secured for safety</li>
                            <li>Ensure valuable items are accessible</li>
                        </ul>
                    </div>

                    <!-- Contact & Reschedule Options -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <h6>Need to Reschedule?</h6>
                                    <p class="small text-muted">Call us at least 24 hours in advance</p>
                                    <a href="tel:+15551234567" class="btn btn-outline-primary">
                                        <i class="fas fa-phone me-2"></i>(555) 123-4567
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h6>Questions or Concerns?</h6>
                                    <p class="small text-muted">We're here to help 24/7</p>
                                    <a href="mailto:support@alphasecuritybureau.com" class="btn btn-outline-success">
                                        <i class="fas fa-envelope me-2"></i>Contact Support
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="text-center mt-4">
                        <h5>Next Steps:</h5>
                        <div class="d-grid gap-2 d-md-block">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-user me-2"></i>Access Your Account
                            </a>
                            <a href="{{ route('payment.form') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Complete Payment Setup
                            </a>
                        </div>

                        <p class="mt-3 text-muted">
                            <small>You'll receive a reminder email 24 hours before your appointment</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.step-indicator {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex: 1;
}

.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 8px;
    color: #6c757d;
}

.step-indicator.active .step-circle,
.step-indicator.completed .step-circle {
    background-color: #198754;
    color: white;
}

.step-line {
    height: 2px;
    background-color: #e9ecef;
    flex: 1;
    margin: 0 20px;
    margin-top: 20px;
}

.step-line.completed {
    background-color: #198754;
}

.appointment-detail {
    margin-bottom: 1rem;
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 8px;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #0d6efd;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.timeline-content h6 {
    color: #0d6efd;
    margin-bottom: 5px;
}

.timeline-content p {
    margin-bottom: 0;
    color: #6c757d;
}
</style>
@endpush