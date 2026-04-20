<header class="header-main sticky-top shadow-lg">
    <div class="header-bg-overlay"></div>
    <div class="header-pattern-right"></div>

    <div class="position-relative" style="z-index: 1000;"> 
        <div class="container">
            <div class="d-flex align-items-center py-3">
                <a class="navbar-brand d-flex align-items-center text-decoration-none text-white" href="{{ url('/') }}">
                    <div class="logo-wrapper">
                        <img src="{{ asset('image/logo.png') }}" alt="Logo" width="55" height="55">
                    </div>
                    <div class="ms-3">
                        <div class="brand-title">POLITEKNIK NEGERI INDRAMAYU</div>
                        <div class="brand-subtitle">Repository & Expo Project</div>
                    </div>
                </a>

                <div class="ms-auto">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-login-modern">Masuk</a>
                    @endguest

                    @auth
                        <div class="dropdown">
                            <a class="user-pill d-flex align-items-center text-decoration-none" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-meta text-end me-2 d-none d-md-block text-white">
                                    <div class="user-name-compact">
                                        {{ Auth::user()->username }}
                                        <span class="status-dot ms-1"></span>
                                    </div>
                                </div>
                                <div class="avatar-container">
                                    <img src="{{ Auth::user()->foto ? asset('image/'.Auth::user()->foto) : asset('image/profile-default.png') }}" class="user-avatar">
                                </div>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 animated-fade-up custom-dropdown-pos">
                                <li class="px-3 py-2 bg-light rounded-top d-md-none">
                                    <div class="fw-bold text-dark text-truncate">{{ Auth::user()->username }}</div>
                                </li>
                                <li><a class="dropdown-item py-2" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                                <li><hr class="dropdown-divider m-0"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2"><i class="bi bi-power me-2"></i> Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <nav class="nav-bottom-clean">
            <div class="container">
                <ul class="nav justify-content-start">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link-modern {{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                    <li class="nav-item"><a href="{{ url('/repository') }}" class="nav-link-modern {{ Request::is('repository*') ? 'active' : '' }}">Repository</a></li>
                    <li class="nav-item"><a href="{{ url('/expo') }}" class="nav-link-modern {{ Request::is('expo*') ? 'active' : '' }}">Expo</a></li>
                    <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link-modern {{ Request::is('about*') ? 'active' : '' }}">Tentang</a></li>
                    <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link-modern {{ Request::is('contact*') ? 'active' : '' }}">Kontak</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="header-divider-shadow"></div>
</header>

<style>
    /* UTAMA */
    .header-main {
        background-color: #002f6c;
        position: relative;
        overflow: visible !important;
        z-index: 1030;
    }

    /* BACKGROUND & PATTERN */
    .header-bg-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at 15% 50%, #004299 0%, #002555 100%);
        z-index: 1;
    }

    .header-pattern-right {
        position: absolute;
        top: 0; right: 0; width: 60%; height: 100%;
        z-index: 2;
        opacity: 0.15;
        pointer-events: none;
        background-image: 
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 300' fill='%23ffffff'%3E%3Cpath d='M600 300V150h40v-20h20v20h40v150zM500 300V100h60v200zM720 300V180h50v120zM400 300V200h80v100z'/%3E%3C/svg%3E");
        background-position: bottom right;
        background-size: contain;
        background-repeat: no-repeat;
    }

    /* BRANDING */
    .brand-title { font-weight: 800; font-size: 1.2rem; color: #fff; letter-spacing: -0.5px; line-height: 1.2; }
    .brand-subtitle { font-size: 0.8rem; color: rgba(255,255,255,0.6); text-transform: uppercase; }
    .logo-wrapper { background: rgba(255,255,255,0.08); padding: 5px; border-radius: 12px; backdrop-filter: blur(5px); }

    /* NAVIGASI */
    .nav-bottom-clean { padding-bottom: 12px; position: relative; z-index: 10; }
    .nav-link-modern {
        color: rgba(255, 255, 255, 0.55) !important;
        font-weight: 500;
        font-size: 0.95rem;
        padding: 10px 18px !important;
        transition: all 0.3s ease;
        text-decoration: none !important;
    }
    .nav-link-modern:hover { color: #ffffff !important; }
    .nav-link-modern.active {
        color: #ffffff !important; 
        font-weight: 700;
        text-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
    }

    /* PEMBATAS BAYANGAN (SHADOW DIVIDER) */
    .header-divider-shadow {
        position: absolute;
        bottom: -15px; /* Menjorok ke luar header */
        left: 0;
        width: 100%;
        height: 15px;
        background: linear-gradient(to bottom, rgba(0,0,0,0.15), transparent);
        pointer-events: none;
        z-index: 5;
    }

    /* USER PROFILE & DROPDOWN */
    .user-pill {
        background: rgba(255,255,255,0.1);
        padding: 4px 4px 4px 12px;
        border-radius: 50px;
        border: 1px solid rgba(255,255,255,0.15);
        transition: 0.3s;
    }
    .user-pill:hover { background: rgba(255,255,255,0.2); }
    .user-name-compact { font-size: 0.85rem; font-weight: 600; }
    .status-dot { height: 7px; width: 7px; background: #00ff88; border-radius: 50%; display: inline-block; box-shadow: 0 0 5px #00ff88; }
    .user-avatar { width: 34px; height: 34px; border-radius: 50%; border: 1px solid #fff; object-fit: cover; }

    .custom-dropdown-pos { z-index: 9999 !important; margin-top: 10px !important; border-radius: 12px !important; }
    .btn-login-modern { background: #ffffff; color: #002f6c; padding: 8px 25px; border-radius: 10px; font-weight: 700; transition: 0.3s; }
    .btn-login-modern:hover { transform: translateY(-1px); background: #f8f9fa; }

    .animated-fade-up { animation: fadeUp 0.3s ease-out; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>