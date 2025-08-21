@extends('layouts.app')

@section('content')
<div class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Protect Your Assets with Professional Documentation</h1>
                <p class="lead mb-4">
                    We send a licensed security officer to your home to document your valuables and receipts, 
                    so you're protected in case of theft, fire, or fraud.
                </p>
                
                <!-- Key Benefits -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <span>Fast insurance claim approval with proof</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt me-2"></i>
                            <span>Licensed, background-checked officers at your home</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-peace me-2"></i>
                            <span>Peace of mind + title fraud protection add-on</span>
                        </div>
                    </div>
                </div>

                <a href="#signup-form" class="btn btn-light btn-lg px-5">
                    📅 Schedule Your Free Audit Now
                </a>
            </div>
            
            <div class="col-lg-6">
                <img src="/images/security-officer.jpg" alt="Security Officer" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<!-- Signup Form Section -->
<section id="signup-form" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Schedule Your Free Home Audit</h3>
                        <p class="mb-0">Get started in under 2 minutes</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <form id="signup-form" action="{{ route('appointment.store') }}" method="POST">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Mobile Phone *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                
                                <div class="col-12">
                                    <label for="address" class="form-label">Home Address *</label>
                                    <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="preferred_date" class="form-label">Preferred Date *</label>
                                    <input type="date" class="form-control" id="preferred_date" name="preferred_date" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="preferred_time" class="form-label">Preferred Time *</label>
                                    <select class="form-control" id="preferred_time" name="preferred_time" required>
                                        <option value="">Select Time</option>
                                        <option value="09:00">9:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="13:00">1:00 PM</option>
                                        <option value="14:00">2:00 PM</option>
                                        <option value="15:00">3:00 PM</option>
                                        <option value="16:00">4:00 PM</option>
                                    </select>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="receipts_ready" name="receipts_ready" required>
                                        <label class="form-check-label" for="receipts_ready">
                                            I will have my receipts and valuables ready for documentation
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        Schedule Free Audit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="text-center">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-camera text-white fa-2x"></i>
                    </div>
                    <h4>Professional Documentation</h4>
                    <p>Our licensed officers photograph and catalog all your valuables with detailed descriptions.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="text-center">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-file-alt text-white fa-2x"></i>
                    </div>
                    <h4>Insurance Ready Reports</h4>
                    <p>Receive comprehensive reports that insurance companies accept for fast claim processing.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="text-center">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt text-white fa-2x"></i>
                    </div>
                    <h4>Title Fraud Protection</h4>
                    <p>Optional add-on service monitors your home deed for any unauthorized changes or fraud attempts.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Set minimum date to today and maximum to 7 days from now
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 7);
    
    document.getElementById('preferred_date').min = today.toISOString().split('T')[0];
    document.getElementById('preferred_date').max = maxDate.toISOString().split('T')[0];
    
    // Form submission
    $('#audit-form').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect_url;
                } else {
                    alert('There was an error processing your request. Please try again.');
                }
            },
            error: function(xhr) {
                console.error('Form submission error:', xhr);
                alert('There was an error. Please check your information and try again.');
            }
        });
    });
});
</script>
@endpush
