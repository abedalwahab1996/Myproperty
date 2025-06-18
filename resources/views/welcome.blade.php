@extends('layouts.app')

@push('styles')
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fas fa-building me-2"></i>MY PROPERTY
            </a>
            <div class="d-flex align-items-center">
                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary px-4 ms-2">Logout</button>
                </form>                @else
                    <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 ms-2">Register</a>
                    @endif

                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container py-5 mt-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-5 fw-bold mb-4">Smart Property Solutions for Modern Investors</h1>
                    <p class="lead text-secondary mb-4">Expert valuation, management, and commercial real estate services to maximize your property investments.</p>
                    <!-- <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-primary px-4 py-3">Explore Services</a>
                        <a href="#" class="btn btn-outline-primary px-4 py-3">
                            <i class="fas fa-phone me-2"></i>Contact Us
                        </a>
                    </div> -->
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Modern building" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="badge bg-primary-soft text-primary mb-3">OUR SERVICES</span>
                <h2 class="fw-bold mb-3">Comprehensive Real Estate Solutions</h2>
                <p class="text-secondary mx-auto" style="max-width: 600px;">Professional services tailored to meet your property investment goals and business needs.</p>
            </div>

            <div class="row g-4">
                <!-- Property Valuation Card -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body p-4">
                            <div class="icon-container bg-primary-soft text-primary mb-4">
                                <i class="fas fa-chart-line fa-lg"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Property Valuation</h3>
                            <p class="text-secondary mb-4">Get precise market valuations from our certified assessors with decades of industry experience.</p>
                        </div>
                    </div>
                </div>

                <!-- Commercial Real Estate Card -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body p-4">
                            <div class="icon-container bg-primary-soft text-primary mb-4">
                                <i class="fas fa-building fa-lg"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Commercial Real Estate</h3>
                            <p class="text-secondary mb-4">Strategic solutions for businesses seeking prime office, retail, and industrial properties.</p>
                        </div>
                    </div>
                </div>

                <!-- Property Management Card -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body p-4">
                            <div class="icon-container bg-primary-soft text-primary mb-4">
                                <i class="fas fa-home fa-lg"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Property Management</h3>
                            <p class="text-secondary mb-4">End-to-end management services to optimize your rental property performance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <!-- <section class="py-5 bg-primary text-white">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Ready to optimize your real estate investments?</h2>
                    <p class="mb-0 opacity-75">Our team of specialists is ready to assist you with personalized solutions.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#" class="btn btn-light px-4 py-3 fw-bold">Schedule Consultation</a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h3 class="h5 fw-bold mb-3">EstatePro</h3>
                    <p class="text-white-50">Professional real estate services to help you buy, sell, and manage properties with confidence.</p>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h4 class="h6 fw-bold mb-3">Services</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Valuation</a></li>
                                <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Commercial</a></li>
                                <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Management</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h4 class="h6 fw-bold mb-3">Company</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">About Us</a></li>
                                <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Team</a></li>
                                <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Careers</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4 class="h6 fw-bold mb-3">Contact</h4>
                            <ul class="list-unstyled text-white-50">
                                <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Business Ave</li>
                                <li class="mb-2"><i class="fas fa-phone me-2"></i> (555) 123-4567</li>
                                <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@estatepro.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="small text-white-50 mb-3 mb-md-0">© 2023 EstatePro. All rights reserved.</p>
                <div class="social-links">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('scripts')
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/welcome.js') }}"></script>
@endpush
