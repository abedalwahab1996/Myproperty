<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My Property - Real Estate Solutions')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Meta Tags -->
    <meta name="description" content="Premium real estate solutions for buyers and sellers">
    <meta name="keywords" content="real estate, property, homes, furniture">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    @stack('styles')


</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-building fa-lg me-2" style="color: var(--secondary-color);"></i>
                <span class="fw-bold">MY PROPERTY</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="{{route('user.property.index')}}">Properties</a>

                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="{{route('user.furniture.index') }}">Furniture</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-primary rounded-pill px-3 dropdown-toggle d-flex align-items-center"
                                type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>
                            <span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end mt-2 border-0 shadow-lg">

                            <li><hr class="dropdown-divider my-1"></li>

                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-user-circle me-2 text-muted"></i> My Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider my-1"></li>



@if(auth()->user()->properties->count() > 0)
    <li>
        <a class="dropdown-item py-2" href="{{ route('user.property.show', auth()->user()->properties->first()->id) }}">
            <i class="fas fa-edit me-2 text-primary"></i> Edit Property
        </a>
    </li>
@endif

                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-hourglass-half me-2 text-warning"></i> Pending Approvals
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('user.furniture.myfurniture') }}">
                                    <i class="fas fa-couch me-2 text-info"></i> My Furniture
                                </a>
                            </li>

                            <li><hr class="dropdown-divider my-1"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2">
                                        <i class="fas fa-sign-out-alt me-2 text-danger"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4 mt-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-3">
                        <i class="fas fa-building me-2"></i> MY PROPERTY
                    </h5>

                    <div class="social-links mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Properties</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Furniture</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">About Us</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-3">Support</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Terms of Service</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Help Center</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-3">Newsletter</h5>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email" aria-label="Your email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="my-4 bg-secondary">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="copyright mb-0">
                        &copy; {{ date('Y') }} My Property. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="copyright mb-0">
                        Made with <i class="fas fa-heart text-danger"></i> by Aqaraty Team
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
