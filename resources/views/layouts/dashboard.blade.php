<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | @yield('title')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset(path: 'css/dashboard.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="admin-layout">
    <!-- Admin Header -->
    <header class="admin-header text-white p-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="sidebar-toggle btn btn-sm btn-outline-light me-3 d-lg-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="h4 mb-0">
                        <i class="fas fa-cogs me-2"></i>Dashboard
                    </h1>
                </div>
                <div class="admin-user-menu">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle text-white" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-user me-2"></i> Profile
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Wrapper -->
    <div class="admin-wrapper d-flex">
        <!-- Sidebar -->
<aside class="admin-sidebar" id="sidebar">
    <div class="sidebar-sticky pt-3">
        <nav class="nav flex-column px-3">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users text-primary"></i> Users
            </a>
            <a class="nav-link" href="{{route('admin.property.index')}}">
                <i class="fas fa-home text-success"></i> Properties
            </a>
            <a class="nav-link" href="{{ route('admin.furniture.index') }}">
                <i class="fas fa-couch text-warning"></i> Furniture
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart text-info"></i> Orders
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-chart-line text-danger"></i> Analytics
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-cog text-secondary"></i> Settings
            </a>
        </nav>
    </div>
</aside>

        <!-- Main Content -->
        <main class="admin-main-content">
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>

    @stack('scripts')
</body>
</html>
