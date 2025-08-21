<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha Security Bureau - Professional Home Asset Documentation</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        .min-vh-75 {
            min-height: 75vh;
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            font-size: 2rem;
        }
        
        .trust-badge {
            transition: transform 0.3s ease;
        }
        
        .trust-badge:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .testimonial-card {
            border-left: 4px solid var(--primary);
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .accordion-button:not(.collapsed) {
            background-color: rgba(13, 110, 253, 0.1);
            color: var(--primary);
            font-weight: 600;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 3rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 2px;
        }
        
        .nav-link {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--dark);
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
        }
        
        .navbar-brand span {
            color: var(--primary);
        }
        
        footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }
        
        footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        footer a:hover {
            color: white;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }
        
        .social-icon:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Alpha<span>Security</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary rounded-pill" href="#signup-form">Schedule Audit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center min-vh-75">
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
                                <i class="fas fa-check-circle me-3 text-warning"></i>
                                <span>Fast insurance claim approval with proof</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt me-3 text-warning"></i>
                                <span>Licensed, background-checked officers</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-peace me-3 text-warning"></i>
                                <span>Peace of mind + title fraud protection add-on</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#signup-form" class="btn btn-light btn-lg px-5 rounded-pill shadow">
                            <i class="fas fa-calendar-check me-2"></i>Schedule Free Audit
                        </a>
                        <a href="#how-it-works" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                            <i class="fas fa-play-circle me-2"></i>How It Works
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Security Officer" class="img-fluid rounded shadow-lg">
                        <div class="position-absolute bottom-0 start-0 bg-primary p-3 rounded-end rounded-top shadow">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle p-2 me-2">
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">4.9/5 Rating</p>
                                    <small>From 500+ Clients</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trust Badges Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center align-items-center">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="trust-badge">
                        <img src="https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" alt="ASIS Certified" class="img-fluid mb-2" style="height: 60px;">
                        <small class="d-block text-muted">ASIS Certified</small>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="trust-badge">
                        <img src="https://images.unsplash.com/photo-1611346656065-5ce3b9e6eaf4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" alt="BBB Accredited" class="img-fluid mb-2" style="height: 60px;">
                        <small class="d-block text-muted">BBB Accredited</small>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="trust-badge">
                        <img src="https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Licensed Security" class="img-fluid mb-2" style="height: 60px;">
                        <small class="d-block text-muted">Licensed Security</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="bg-primary rounded-circle p-3 me-3">
                            <i class="fas fa-phone text-white fa-2x"></i>
                        </div>
                        <div>
                            <strong class="d-block">(555) 123-4567</strong>
                            <small class="text-muted">24/7 Support</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="services" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold section-title">Why Choose Alpha Security Bureau?</h2>
                <p class="lead text-muted">Professional documentation that insurance companies trust</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="text-center h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h4>Professional Documentation</h4>
                        <p>Our licensed officers photograph and catalog all your valuables with detailed descriptions and serial numbers.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="text-center h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h4>Insurance Ready Reports</h4>
                        <p>Receive comprehensive reports that insurance companies accept for fast claim processing and verification.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="text-center h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Secure & Confidential</h4>
                        <p>All data is encrypted and stored securely with bank-level security. Only you control access to your records.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="text-center h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Quick Process</h4>
                        <p>Our efficient documentation process takes just 1-2 hours, minimizing disruption to your schedule.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="text-center h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h4>Annual Updates</h4>
                        <p>We offer annual update services to keep your inventory current as you acquire new valuable items.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="text-center h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-user-lock"></i>
                        </div>
                        <h4>Vetted Professionals</h4>
                        <p>All our security officers undergo thorough background checks and receive specialized training.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold section-title">How Our Service Works</h2>
                <p class="lead text-muted">Simple, secure, and professional process for your peace of mind</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">1</span>
                            </div>
                            <h4>Schedule Free Audit</h4>
                            <p>Book your appointment online or by phone at your convenience.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">2</span>
                            </div>
                            <h4>Officer Visit</h4>
                            <p>Our licensed security professional visits your home to document your valuables.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">3</span>
                            </div>
                            <h4>Receive Report</h4>
                            <p>Get a comprehensive digital and physical report of all documented items.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">4</span>
                            </div>
                            <h4>Stay Protected</h4>
                            <p>Rest easy knowing you're prepared for insurance claims and potential disputes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold section-title">What Our Clients Say</h2>
                <p class="lead text-muted">Hear from homeowners who have protected their assets with our service</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 testimonial-card">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="fst-italic">"The officer was professional and thorough. When our home was burglarized, our insurance claim was approved in 48 hours thanks to the detailed documentation!"</p>
                            <div class="d-flex align-items-center mt-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span>SM</span>
                                </div>
                                <div>
                                    <strong>Sarah M.</strong>
                                    <p class="mb-0 text-muted">Denver, CO</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 testimonial-card">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="fst-italic">"Peace of mind knowing all our valuables are properly documented. The title monitoring add-on caught attempted fraud early and saved us from a nightmare!"</p>
                            <div class="d-flex align-items-center mt-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span>MT</span>
                                </div>
                                <div>
                                    <strong>Mike T.</strong>
                                    <p class="mb-0 text-muted">Austin, TX</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 testimonial-card">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="fst-italic">"Highly recommend! The report was incredibly detailed and professional. Made our insurance claim process seamless after a kitchen fire damaged our home."</p>
                            <div class="d-flex align-items-center mt-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span>LK</span>
                                </div>
                                <div>
                                    <strong>Lisa K.</strong>
                                    <p class="mb-0 text-muted">Phoenix, AZ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold section-title">Transparent Pricing</h2>
                <p class="lead text-muted">Choose the plan that works best for your needs</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow h-100">
                        <div class="card-header bg-white text-center py-4">
                            <h3 class="fw-bold">Basic Documentation</h3>
                            <div class="price display-4 fw-bold text-primary">$199</div>
                            <p class="text-muted">One-time fee</p>
                        </div>
                        <div class="card-body p-4">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Document up to 25 items</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Digital inventory report</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Photo documentation</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> 1-year secure cloud storage</li>
                                <li class="mb-3"><i class="fas fa-times text-secondary me-2"></i> No physical copy</li>
                                <li class="mb-3"><i class="fas fa-times text-secondary me-2"></i> No title monitoring</li>
                            </ul>
                            <a href="#signup-form" class="btn btn-outline-primary w-100 py-3">Select Plan</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow h-100">
                        <div class="card-header bg-primary text-white text-center py-4 position-relative">
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-warning text-dark">Most Popular</span>
                            <h3 class="fw-bold">Complete Protection</h3>
                            <div class="price display-4 fw-bold text-white">$299</div>
                            <p>One-time fee</p>
                        </div>
                        <div class="card-body p-4">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Document unlimited items</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Digital + physical inventory report</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Photo + video documentation</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> 5-year secure cloud storage</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Priority support</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> 1 year title monitoring</li>
                            </ul>
                            <a href="#signup-form" class="btn btn-primary w-100 py-3">Select Plan</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow h-100">
                        <div class="card-header bg-white text-center py-4">
                            <h3 class="fw-bold">Elite Package</h3>
                            <div class="price display-4 fw-bold text-primary">$499</div>
                            <p class="text-muted">One-time fee</p>
                        </div>
                        <div class="card-body p-4">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Document unlimited items</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Premium leather-bound report</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Professional photo + video documentation</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Lifetime secure cloud storage</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> 24/7 dedicated support</li>
                                <li class="mb-3"><i class="fas fa-check text-success me-2"></i> 3 years title monitoring</li>
                            </ul>
                            <a href="#signup-form" class="btn btn-outline-primary w-100 py-3">Select Plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Signup Form Section -->
    <section id="signup-form" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h3 class="mb-0">Schedule Your Free Home Security Audit</h3>
                            <p class="mb-0">Takes 2 minutes • Free consultation • No obligations</p>
                        </div>
                        
                        <div class="card-body p-5">
                            <form id="audit-form">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control form-control-lg" id="phone" name="phone" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="preferred_date" class="form-label">Preferred Date *</label>
                                        <input type="date" class="form-control form-control-lg" id="preferred_date" name="preferred_date" required>
                                        <small class="text-muted">Available within next 7 days</small>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="preferred_time" class="form-label">Preferred Time *</label>
                                        <input type="time" class="form-control form-control-lg" id="preferred_time" name="preferred_time" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="service_package" class="form-label">Service Package</label>
                                        <select class="form-select form-control-lg" id="service_package" name="service_package">
                                            <option value="basic">Basic Documentation ($199)</option>
                                            <option value="complete" selected>Complete Protection ($299)</option>
                                            <option value="elite">Elite Package ($499)</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="address" class="form-label">Home Address *</label>
                                        <textarea class="form-control form-control-lg" id="address" name="address" rows="3" required placeholder="Enter your complete address"></textarea>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="city" class="form-label">City *</label>
                                        <input type="text" class="form-control form-control-lg" id="city" name="city" required>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control form-control-lg" id="state" name="state">
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label for="zip_code" class="form-label">ZIP Code</label>
                                        <input type="text" class="form-control form-control-lg" id="zip_code" name="zip_code">
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="receipts_ready" name="receipts_ready" required>
                                            <label class="form-check-label" for="receipts_ready">
                                                <strong>I confirm that I have receipts and documentation ready for valuable items (jewelry, electronics, art, etc.)</strong>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                                            <label class="form-check-label" for="agree_terms">
                                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of Service</a>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                                            <i class="fas fa-calendar-check me-2"></i>
                                            Schedule My Free Audit
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

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold section-title">Frequently Asked Questions</h2>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How long does the audit take?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Typically 1-2 hours depending on the number of valuable items to document. Our security officers work efficiently to minimize disruption to your schedule.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Is this really free?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, the initial audit and consultation is completely free with no obligations. We only charge if you decide to proceed with our documentation service after the audit.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    What should I prepare?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Gather receipts, warranties, and appraisals for valuable items like jewelry, electronics, art, and collectibles. Also have serial numbers and purchase dates available when possible.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Are your security officers licensed?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, all our security officers are fully licensed, bonded, and insured. They undergo thorough background checks and receive specialized training in asset documentation.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    How is my data stored and protected?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    All data is encrypted and stored securely with bank-level security measures. We use AES-256 encryption and multi-factor authentication to ensure only authorized access to your information.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="text-white mb-4">Alpha Security Bureau</h4>
                    <p>Professional home asset documentation services to protect your valuables and provide peace of mind.</p>
                    <div class="d-flex mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#services">Services</a></li>
                        <li class="mb-2"><a href="#how-it-works">How It Works</a></li>
                        <li class="mb-2"><a href="#pricing">Pricing</a></li>
                        <li class="mb-2"><a href="#testimonials">Testimonials</a></li>
                        <li class="mb-2"><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (555) 123-4567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@alphasecurity.com</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Security Ave, Suite 100</li>
                        <li class="mb-2">Denver, CO 80202</li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Business Hours</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">Monday-Friday: 8am - 6pm</li>
                        <li class="mb-2">Saturday: 9am - 4pm</li>
                        <li class="mb-2">Sunday: Closed</li>
                        <li class="mb-2 mt-3"><span class="badge bg-warning text-dark">24/7 Emergency Support</span></li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4 bg-light">
            
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2023 Alpha Security Bureau. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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
            
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
            
            // Show loading state
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Processing...');
            submitBtn.prop('disabled', true);
            
            // Simulate form submission
            setTimeout(function() {
                alert('Thank you for scheduling your free audit! We will contact you shortly to confirm your appointment.');
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
                $('#audit-form')[0].reset();
            }, 2000);
        });
        
        // Smooth scrolling for navigation links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
            }
        });
        
        // Animate elements on scroll
        function animateOnScroll() {
            $('.feature-icon, .trust-badge, .card').each(function() {
                var position = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                
                if (scroll > position - windowHeight + 100) {
                    $(this).addClass('animate__animated animate__fadeInUp');
                }
            });
        }
        
        // Initial call
        animateOnScroll();
        
        // Call on scroll
        $(window).on('scroll', animateOnScroll);
    });
    </script>
</body>
</html>