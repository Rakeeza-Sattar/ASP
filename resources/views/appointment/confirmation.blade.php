<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmed - Alpha Security Bureau</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Header -->
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">
                <i class="fas fa-shield-alt me-2"></i>Alpha Security Bureau
            </a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message -->
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-check-circle fa-4x"></i>
                        </div>
                        <h2 class="mb-0">Appointment Confirmed!</h2>
                        <p class="mb-0">Thank you, {{ $appointment->user->first_name }}. Your free home audit is booked.</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Appointment Details -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="appointment-detail">
                                    <h5><i class="fas fa-calendar text-primary me-2"></i>Date & Time</h5>
                                    <p class="fs-5 fw-bold">{{ $appointment->appointment_date->format('l, F j, Y') }}</p>
                                    <p class="fs-5 fw-bold">{{ $appointment->appointment_date->format('g:i A') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="appointment-detail">
                                    <h5><i class="fas fa-map-marker-alt text-primary me-2"></i>Service Address</h5>
                                    <p>{{ $appointment->address }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Preparation Instructions -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary">
                                    <i class="fas fa-clipboard-list me-2"></i>Please Prepare the Following:
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Receipts for major valuables</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Electronics receipts/warranties</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Jewelry receipts/appraisals</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Appliance warranties</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Artwork/collectibles documents</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Any additional valuables</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Officer Information -->
                        <div class="alert alert-info">
                            <h5><i class="fas fa-user-shield me-2"></i>What to Expect</h5>
                            <p class="mb-1">✅ Your licensed officer will arrive in uniform with proper ID</p>
                            <p class="mb-1">✅ Complete audit typically takes 45-60 minutes</p>
                            <p class="mb-0">✅ You'll receive a detailed incident report after completion</p>
                        </div>

                        <!-- Title Protection Upsell -->
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h4 class="text-warning"><i class="fas fa-shield-alt me-2"></i>Protect Your Home Deed Too!</h4>
                                <p class="mb-3">Want to protect your home deed from fraud? Add Title Protection today for just $50/month.</p>
                                <a href="{{ route('payment.form', ['type' => 'title_protection', 'appointment' => $appointment->id]) }}" 
                                   class="btn btn-warning btn-lg fw-bold">
                                    🏠 Add Title Protection Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="text-center mt-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                                    <h6>Check Your Email</h6>
                                    <p class="small">Confirmation sent to {{ $appointment->user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-bell fa-2x text-warning mb-3"></i>
                                    <h6>Reminder Alert</h6>
                                    <p class="small">We'll remind you 24 hours before</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-phone fa-2x text-success mb-3"></i>
                                    <h6>Need Help?</h6>
                                    <p class="small">Call us: (555) 123-4567</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Option -->
                <div class="text-center mt-4">
                    <a href="{{ route('payment.form', ['appointment' => $appointment->id]) }}" 
                       class="btn btn-primary btn-lg">
                        💳 Complete Payment Now
                    </a>
                    <p class="small text-muted mt-2">You can also pay after your audit is complete</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
