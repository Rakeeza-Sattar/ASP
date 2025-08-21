@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Complete Your Payment</h3>
                </div>
                
                <div class="card-body p-4">
                    <!-- Payment Summary -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5>Service Fee</h5>
                                    <h3 class="text-primary">${{ number_format($amount, 2) }}</h3>
                                    <p class="text-muted mb-0">One-time home audit fee</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5>Monthly Protection</h5>
                                    <h3 class="text-success">${{ number_format($subscriptionAmount, 2) }}</h3>
                                    <p class="text-muted mb-0">Ongoing asset monitoring</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form id="payment-form">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointmentId }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Payment Type</label>
                            <div class="btn-group d-flex" role="group">
                                <input type="radio" class="btn-check" name="payment_type" id="one-time" value="one-time" checked>
                                <label class="btn btn-outline-primary" for="one-time">Service Fee Only</label>
                                
                                <input type="radio" class="btn-check" name="payment_type" id="subscription" value="subscription">
                                <label class="btn btn-outline-success" for="subscription">Service + Monthly Protection</label>
                            </div>
                        </div>

                        <div id="card-container" class="mb-4">
                            <label class="form-label">Card Information</label>
                            <div id="sq-card-number" class="form-control mb-2"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="sq-expiration-date" class="form-control"></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="sq-cvv" class="form-control"></div>
                                </div>
                            </div>
                            <div id="sq-postal-code" class="form-control mt-2"></div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" id="pay-button" class="btn btn-primary btn-lg w-100">
                            Process Payment
                        </button>
                    </form>

                    <!-- Payment Status -->
                    <div id="payment-status" class="mt-3" style="display: none;">
                        <div class="alert" role="alert"></div>
                    </div>
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
                <h5 class="modal-title">Terms & Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Service Agreement</h6>
                <p>Alpha Security Bureau provides asset documentation and optional title monitoring services...</p>
                <!-- Add full terms content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', async function () {
    const appId = '{{ config("square.application_id") }}';
    const locationId = '{{ config("square.location_id") }}';
    
    if (!window.Square) {
        throw new Error('Square.js failed to load properly');
    }

    const payments = window.Square.payments(appId, locationId);
    let card;

    try {
        card = await payments.card();
        await card.attach('#sq-card-number');
        
        // Attach other elements
        await card.attach('#sq-expiration-date');
        await card.attach('#sq-cvv');
        await card.attach('#sq-postal-code');
        
    } catch (e) {
        console.error('Initializing Card failed', e);
        showPaymentStatus('Card initialization failed', 'error');
        return;
    }

    // Payment form submission
    document.getElementById('payment-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const payButton = document.getElementById('pay-button');
        payButton.disabled = true;
        payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

        try {
            const result = await card.tokenize();
            
            if (result.status === 'OK') {
                const token = result.token;
                await processPayment(token);
            } else {
                let errorMessage = 'Payment failed.';
                if (result.errors) {
                    errorMessage = result.errors.map(error => error.message).join(', ');
                }
                showPaymentStatus(errorMessage, 'error');
            }
        } catch (e) {
            console.error('Payment error:', e);
            showPaymentStatus('Payment processing failed', 'error');
        } finally {
            payButton.disabled = false;
            payButton.innerHTML = 'Process Payment';
        }
    });

    async function processPayment(token) {
        const formData = new FormData(document.getElementById('payment-form'));
        formData.append('source_id', token);
        
        const paymentType = document.querySelector('input[name="payment_type"]:checked').value;
        const amount = paymentType === 'subscription' ? 
            ({{ $amount }} + {{ $subscriptionAmount }}) : {{ $amount }};
        
        formData.append('amount', amount);

        try {
            const response = await fetch('{{ route("payment.process") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (result.success) {
                showPaymentStatus('Payment successful! Redirecting...', 'success');
                setTimeout(() => {
                    window.location.href = '{{ route("appointment.confirmation") }}';
                }, 2000);
            } else {
                showPaymentStatus(result.message || 'Payment failed', 'error');
            }
        } catch (e) {
            console.error('Server error:', e);
            showPaymentStatus('Server error occurred', 'error');
        }
    }

    function showPaymentStatus(message, type) {
        const statusDiv = document.getElementById('payment-status');
        const alertDiv = statusDiv.querySelector('.alert');
        
        alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
        alertDiv.textContent = message;
        statusDiv.style.display = 'block';
        
        setTimeout(() => {
            statusDiv.style.display = 'none';
        }, 5000);
    }
});
</script>
@endpush
