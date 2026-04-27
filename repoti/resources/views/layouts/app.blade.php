<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Repo TI - Polindra')</title>
    
    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #1DA1F2;
            --primary-dark: #0d8bd9;
            --secondary: #40C4FF;
            --dark: #2D3142;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            background: #F0F7FF;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .navbar-brand span:first-child {
            color: var(--dark);
        }
        
        .navbar-brand span:last-child {
            color: var(--primary);
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark);
            transition: 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary);
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 10px 24px;
            border-radius: 30px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 30px;
            padding: 8px 24px;
            font-weight: 500;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
        }
        
        footer {
            background: white;
            padding: 40px 0 20px;
            margin-top: 50px;
            border-top: 1px solid rgba(0,0,0,0.05);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span>Repo</span><span>TI</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('repository*') ? 'active' : '' }}" href="{{ url('/repository') }}">Repository</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('expo') ? 'active' : '' }}" href="{{ url('/expo') }}">Expo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ url('/about') }}">Tentang</a>
                </li>
            </ul>
            
            <div class="d-flex gap-2">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i> {{ Auth::user()->username }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ url('/profile/'.Auth::user()->kode) }}">
                                    <i class="bi bi-person"></i> Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ url('/logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-sm">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Main Content --}}
<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3"><span>Repo</span><span class="text-primary">TI</span></h5>
                <p class="text-muted small">Platform repository tugas akhir mahasiswa Politeknik Negeri Indramayu.</p>
            </div>
            <div class="col-md-2 mb-4">
                <h6 class="fw-bold mb-3">Menu</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-muted text-decoration-none small">Home</a></li>
                    <li><a href="{{ url('/repository') }}" class="text-muted text-decoration-none small">Repository</a></li>
                    <li><a href="{{ url('/expo') }}" class="text-muted text-decoration-none small">Expo</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold mb-3">Kontak</h6>
                <ul class="list-unstyled">
                    <li class="text-muted small"><i class="bi bi-envelope me-2"></i> repo@polindra.ac.id</li>
                    <li class="text-muted small"><i class="bi bi-geo-alt me-2"></i> Indramayu, Jawa Barat</li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                <div class="d-flex gap-3">
                    <a href="#" class="text-primary"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-primary"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-primary"><i class="bi bi-github fs-5"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-3">
        <div class="text-center">
            <small class="text-muted">© 2024 RepoTI. All rights reserved.</small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>