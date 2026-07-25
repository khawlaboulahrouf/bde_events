<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BDE Events</title>

    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #10b981;
            --primary-hover: #059669;
            --bg-body: #f8fafc;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-body);
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Modern Styling */
        .navbar-custom {
            background: linear-gradient(135deg, #059669, #10b981);
            box-shadow: 0 4px 20px rgba(5, 150, 105, 0.15);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-pill {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 0.35rem 0.8rem;
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .btn-logout {
            background-color: #ffffff;
            color: #059669;
            border: none;
            font-weight: 600;
            border-radius: 20px;
            padding: 0.35rem 1rem;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: #f1f5f9;
            color: #047857;
            transform: translateY(-1px);
        }

        /* Custom Modern Alerts */
        .alert-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 1rem 1.25rem;
        }

        /* Footer */
        footer {
            margin-top: auto;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1.5rem 0;
            color: #64748b;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="bi bi-mortarboard-fill fs-6"></i>
                </div>
                <span>BDE <span class="fw-light opacity-75">EVENTS</span></span>
            </a>

            @auth
            <div class="ms-auto d-flex align-items-center gap-3">

                <!-- User Profile Badge -->
                <div class="user-pill d-none d-sm-flex align-items-center gap-2">
                    <i class="bi bi-person-circle"></i>
                    <span>Bonjour, <strong>{{ auth()->user()->name }}</strong></span>
                </div>

                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-logout d-flex align-items-center gap-1">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>

            </div>
            @endauth
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="container py-4">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-custom alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dynamic Content -->
        @yield('content')

    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-0">
                © {{ date('Y') }} <strong class="text-dark">BDE EVENTS - ENAA</strong>. Tous droits réservés.
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle (Required for alerts dismissal & tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
