<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restaurant Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --dark-color: #2C3E50;
            --light-color: #ECF0F1;
        }

        .sidebar {
            min-height: 100vh;
            background-color: var(--dark-color);
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            color: var(--light-color);
            padding: 0.8rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }

        .main-content {
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: darken(var(--primary-color), 10%);
            border-color: darken(var(--primary-color), 10%);
        }
    </style>
    @stack('styles')
</head>
<body>
    @auth
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="d-flex justify-content-center mb-4">
                    <h4 class="text-white">Restaurant Admin</h4>
                </div>
                <nav class="nav flex-column">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="bi bi-box"></i> Produits
                    </a>
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i> Catégories
                    </a>
                    <a href="{{ route('ingredients.index') }}" class="nav-link {{ request()->routeIs('ingredients.*') ? 'active' : '' }}">
                        <i class="bi bi-egg-fried"></i> Ingrédients
                    </a>
                    <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                        <i class="bi bi-cart"></i> Commandes
                    </a>
                    <a href="{{ route('promocodes.index') }}" class="nav-link {{ request()->routeIs('promocodes.*') ? 'active' : '' }}">
                        <i class="bi bi-tag"></i> Codes Promo
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>
    @else
        @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
