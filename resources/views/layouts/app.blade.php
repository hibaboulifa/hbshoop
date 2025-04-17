<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HbShoop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS personnalisé -->
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        main {
            flex: 1;
        }

        .badge-notification {
            background-color: red;
            color: white;
            font-size: 0.75rem;
            padding: 0.2em 0.5em;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -10px;
        }

        .nav-link.position-relative {
            display: inline-block;
        }

    </style>
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}"> HbShoop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-bar-chart"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam"></i> Produits</a>
                            </li>
                        @elseif(auth()->user()->role === 'customer')
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                    <i class="bi bi-cart"></i> Panier
                                    @php
                                        $cartCount = session('cart') ? count(session('cart')) : 0;
                                    @endphp
                                    @if($cartCount > 0)
                                        <span class="badge-notification">{{ $cartCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.index') }}"><i class="bi bi-bag"></i> Produits</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">⭐ Points : {{ Auth::user()->points ?? 0 }}</span>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">🚪 Déconnexion</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Inscription</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Notifications -->
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="container mt-3">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Footer -->
    <footer class="bg-dark text-white mt-auto py-4 text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} HShop. Tous droits réservés.</p>
            <div>
                <a href="#" class="text-white me-3">Conditions d'utilisation</a>
                <a href="#" class="text-white me-3">Politique de confidentialité</a>
                <a href="#" class="text-white">Contact</a>
            </div>
            <div class="mt-2">
                <a href="#"><i class="bi bi-facebook text-white me-2"></i></a>
                <a href="#"><i class="bi bi-instagram text-white me-2"></i></a>
                <a href="#"><i class="bi bi-twitter text-white"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
