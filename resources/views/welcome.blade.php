
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha Security Bureau - Asset Protection Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fas fa-shield-alt me-2"></i>Alpha Security Bureau
            </a>
            <div class="navbar-nav ms-auto">
                <div class="d-flex align-items-center">
                    <span class="me-3"><i class="fas fa-phone text-primary me-1"></i> (555) 123-4567</span>
                    <div class="trust-badges">
                        <img src="https://via.placeholder.com/50x30/0066CC/FFFFFF?text=ASIS" alt="ASIS Certified" class="me-2">
                        <img src="https://via.placeholder.com/50x30/FF6600/FFFFFF?text=BBB" alt="BBB Accredited" class="me-2">
                        <img src="https://via.placeholder.com/60x30/009900/FFFFFF?text=Licensed" alt="Licensed Security">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">Protect Your Valuables Before It's Too Late</h1>
                    <p class="lead mb-4">We send a licensed security officer to your home to document your valuables and receipts, so you're protected in case of theft, fire, or fraud.</p>
                    
                    <!-- Key Benefits -->
                    <div class="benefits mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-warning me-3"></i>
                            <span>Fast insurance claim approval with proof</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-warning me-3"></i>
                            <span>Licensed, background-checked officers at your home</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-warning me-3"></i>
                            <span>Peace of mind + title fraud protection add-on</span>
                        </div>
                    </div>

                    <button class="btn btn-warning btn-lg fw-bold px-4 py-3" onclick="scrollToBooking()">
                        📅 Schedule Your Free Audit Now
                    </button>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400/FFFFFF/000000?text=Security+Officer+Documenting+Valuables" alt="Security Officer" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial text-center">
                        <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                        <p class="mb-3">"When our house was burglarized, Alpha's documentation helped us get our full insurance claim in just 2 weeks!"</p>
                        <strong>- Sarah M., Dallas</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial text-center">
                        <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                        <p class="mb-3">"Professional officer arrived on time, very thorough documentation. Highly recommend!"</p>
                        <strong>- Mike R., Houston</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial text-center">
                        <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                        <p class="mb-3">"Title monitoring saved us from fraud attempt. Worth every penny!"</p>
                        <strong>- Jennifer L., Austin</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section id="booking-section" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h2 class="mb-0">Schedule Your Free Home Audit</h2>
                            <p class="mb-0">Complete documentation in under 60 minutes</p>
                        </div>
                        <div class="card-body p-4">
                            <form id="appointment-form" action="{{ route('appointment.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="full_name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Mobile Phone Number *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="appointment_date" class="form-label">Preferred Date *</label>
                                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">Home Address (Service Location) *</label>
                                    <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="preferred_time" class="form-label">Preferred Time *</label>
                                    <select class="form-control" id="preferred_time" name="preferred_time" required>
                                        <option value="">Select Time</option>
                                        <option value="09:00">9:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="12:00">12:00 PM</option>
                                        <option value="13:00">1:00 PM</option>
                                        <option value="14:00">2:00 PM</option>
                                        <option value="15:00">3:00 PM</option>
                                        <option value="16:00">4:00 PM</option>
                                        <option value="17:00">5:00 PM</option>
                                    </select>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="valuables_ready" name="valuables_ready" required>
                                        <label class="form-check-label" for="valuables_ready">
                                            I will have my receipts and valuables ready for documentation.
                                        </label>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                                    📅 Book My Free Audit Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="mb-3">Don't Wait Until It's Too Late</h2>
            <p class="lead mb-4">Thousands of families lose their valuables every year without proper documentation</p>
            <button class="btn btn-warning btn-lg fw-bold px-5 py-3" onclick="scrollToBooking()">
                📅 Schedule Your Free Audit Now
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Alpha Security Bureau</h5>
                    <p>Licensed Asset Protection & Documentation Services</p>
                </div>
                <div class="col-md-6 text-end">
                    <p>Call Us: (555) 123-4567</p>
                    <p>Available 24/7 for Emergencies</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set minimum date to today and maximum to 7 days from now
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('appointment_date');
            const today = new Date();
            const maxDate = new Date();
            maxDate.setDate(today.getDate() + 7);
            
            dateInput.min = today.toISOString().split('T')[0];
            dateInput.max = maxDate.toISOString().split('T')[0];
        });

        function scrollToBooking() {
            document.getElementById('booking-section').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Form submission
        document.getElementById('appointment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    alert('Error booking appointment. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error booking appointment. Please try again.');
            });
        });
    </script>
</body>
</html>
