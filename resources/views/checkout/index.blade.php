
@extends('layouts.app')

@section('title', 'Schedule Your Free Home Security Audit')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Progress Indicator -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="step-indicator active">
                        <div class="step-circle">1</div>
                        <span>Appointment Details</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-indicator">
                        <div class="step-circle">2</div>
                        <span>Confirmation</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">📅 Schedule Your Free Home Security Audit</h3>
                    <p class="mb-0">Takes 2 minutes • Free consultation • No obligations</p>
                </div>
                
                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Personal Information -->
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-user me-2"></i>Personal Information
                                </h5>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" 
                                       value="{{ old('name') }}" required placeholder="Enter your full name">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" 
                                       value="{{ old('email') }}" required placeholder="your@email.com">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control form-control-lg" id="phone" name="phone" 
                                       value="{{ old('phone') }}" required placeholder="(555) 123-4567">
                            </div>
                            
                            <!-- Address Information -->
                            <div class="col-12 mt-4">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-home me-2"></i>Property Address
                                </h5>
                            </div>
                            
                            <div class="col-12">
                                <label for="address" class="form-label">Street Address *</label>
                                <textarea class="form-control form-control-lg" id="address" name="address" rows="2" 
                                          required placeholder="Enter your complete street address">{{ old('address') }}</textarea>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control form-control-lg" id="city" name="city" 
                                       value="{{ old('city') }}" placeholder="City">
                            </div>
                            
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control form-control-lg" id="state" name="state" 
                                       value="{{ old('state') }}" placeholder="State">
                            </div>
                            
                            <div class="col-md-4">
                                <label for="zip_code" class="form-label">ZIP Code</label>
                                <input type="text" class="form-control form-control-lg" id="zip_code" name="zip_code" 
                                       value="{{ old('zip_code') }}" placeholder="12345">
                            </div>
                            
                            <!-- Appointment Scheduling -->
                            <div class="col-12 mt-4">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-calendar me-2"></i>Preferred Appointment Date
                                </h5>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="preferred_date" class="form-label">Preferred Date *</label>
                                <input type="date" class="form-control form-control-lg" id="preferred_date" 
                                       name="preferred_date" value="{{ old('preferred_date') }}" required>
                                <small class="text-muted">Available within next 7 days only</small>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="preferred_time" class="form-label">Preferred Time</label>
                                <select class="form-select form-select-lg" id="preferred_time" name="preferred_time">
                                    <option value="09:00">9:00 AM</option>
                                    <option value="10:00" selected>10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="13:00">1:00 PM</option>
                                    <option value="14:00">2:00 PM</option>
                                    <option value="15:00">3:00 PM</option>
                                    <option value="16:00">4:00 PM</option>
                                </select>
                            </div>
                            
                            <!-- Requirements Confirmation -->
                            <div class="col-12 mt-4">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>What You'll Need Ready:</h6>
                                    <ul class="mb-0">
                                        <li>Receipts for valuable items (jewelry, electronics, art, etc.)</li>
                                        <li>Warranty documents</li>
                                        <li>Appraisal certificates</li>
                                        <li>Photo identification</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="receipts_ready" 
                                           name="receipts_ready" required {{ old('receipts_ready') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="receipts_ready">
                                        <strong>I confirm that I have receipts and documentation ready for valuable items 
                                        (jewelry, electronics, art, collectibles, etc.)</strong>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agree_terms" 
                                           name="agree_terms" required {{ old('agree_terms') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="agree_terms">
                                        I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of Service</a> 
                                        and <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3" id="submit-btn">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    Schedule My Free Audit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Trust Indicators -->
            <div class="row mt-4 text-center">
                <div class="col-md-3">
                    <i class="fas fa-shield-alt text-success fa-2x mb-2"></i>
                    <small class="d-block">Licensed & Insured</small>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-user-check text-success fa-2x mb-2"></i>
                    <small class="d-block">Background Checked</small>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-lock text-success fa-2x mb-2"></i>
                    <small class="d-block">Secure & Confidential</small>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-phone text-success fa-2x mb-2"></i>
                    <small class="d-block">24/7 Support</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms of Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Service Agreement</h6>
                <p>By scheduling an appointment with Alpha Security Bureau, you agree to the following terms...</p>
                <!-- Add comprehensive terms -->
            </div>
        </div>
    </div>
</div>

<!-- Privacy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Privacy Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Data Protection</h6>
                <p>Alpha Security Bureau is committed to protecting your privacy and personal information...</p>
                <!-- Add comprehensive privacy policy -->
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

.step-indicator.active .step-circle {
    background-color: #0d6efd;
    color: white;
}

.step-line {
    height: 2px;
    background-color: #e9ecef;
    flex: 1;
    margin: 0 20px;
    margin-top: 20px;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Set date restrictions (next 7 days only)
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 7);
    
    const preferredDateInput = document.getElementById('preferred_date');
    preferredDateInput.min = today.toISOString().split('T')[0];
    preferredDateInput.max = maxDate.toISOString().split('T')[0];
    
    // Phone number formatting
    $('#phone').on('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length >= 6) {
            value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        } else if (value.length >= 3) {
            value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
        }
        this.value = value;
    });
    
    // Form submission
    $('#checkout-form').on('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = $('#submit-btn');
        const originalText = submitBtn.html();
        
        // Show loading state
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Processing...');
        submitBtn.prop('disabled', true);
        
        // Submit form
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect_url;
                } else {
                    alert('There was an error processing your request. Please try again.');
                    submitBtn.html(originalText);
                    submitBtn.prop('disabled', false);
                }
            },
            error: function(xhr) {
                console.error('Form submission error:', xhr);
                alert('There was an error. Please check your information and try again.');
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }
        });
    });
});
</script>
@endpush
