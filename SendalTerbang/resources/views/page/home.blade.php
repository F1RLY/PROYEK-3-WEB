{{-- 1. HERO SECTION (DIKECILKAN) --}}
<section class="hero-home position-relative overflow-hidden" style="background: #002f6c; padding: 50px 0 80px 0;">
    {{-- Blobs asli --}}
    <div class="shape-blob blob-1"></div>
    <div class="shape-blob blob-2"></div>
    
    <div class="container position-relative" style="z-index: 5;">
        <div class="row align-items-center">
            <div class="col-lg-7 text-white text-center text-lg-start">
                <span class="badge rounded-pill px-3 py-2 mb-3" style="background: rgba(255,193,7, 0.15); color: #ffc107; font-size: 0.75rem; letter-spacing: 1px;">
                    OFFICIAL REPOSITORY POLINDRA
                </span>
                <h1 class="display-5 fw-bolder mb-3">Eksplorasi <span class="text-warning">Inovasi</span> & <br class="d-none d-lg-block"> Riset Digital</h1>
                <p class="mb-4 opacity-75 pe-lg-5" style="font-size: 0.95rem; max-width: 600px;">
                    Pusat dokumentasi dan preservasi karya ilmiah terbaik civitas akademika Politeknik Negeri Indramayu.
                </p>
                
                {{-- Search Bar --}}
                <div class="home-search-container p-1 bg-white rounded-3 shadow-lg mb-4" style="max-width: 550px;">
                    <form action="{{ url('/repository') }}" method="GET" class="row g-0 align-items-center">
                        <div class="col-8 col-md-9">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0 pe-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" name="q" class="form-control border-0 py-2 shadow-none" placeholder="Cari riset atau proyek..." style="font-size: 0.95rem;">
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-2 fw-bold">Cari</button>
                        </div>
                    </form>
                </div>

                <div class="d-flex gap-4 justify-content-center justify-content-lg-start mt-2">
                    <div class="text-center">
                        <h5 class="fw-bold mb-0" style="font-size: 1.1rem;">{{ $allProjects->count() }}+</h5>
                        <small class="opacity-50" style="font-size: 0.65rem;">Karya Digital</small>
                    </div>
                    <div class="vr opacity-25"></div>
                    <div class="text-center">
                        <h5 class="fw-bold mb-0" style="font-size: 1.1rem;">2021-{{ date('Y') }}</h5>
                        <small class="opacity-50" style="font-size: 0.65rem;">Arsip Aktif</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block">
                {{-- Tinggi visual stack dikurangi dari 300px ke 250px --}}
                <div class="hero-visual-stack" style="height: 250px; position: relative;">
                    <div class="floating-card-1 shadow-sm py-2 px-3">
                        <i class="bi bi-gear-fill text-warning fs-5"></i>
                        <span class="small fw-bold ms-2 text-dark">Engineering</span>
                    </div>
                    <div class="floating-card-2 shadow-sm py-2 px-3">
                        <i class="bi bi-code-square text-info fs-5"></i>
                        <span class="small fw-bold ms-2 text-dark">IT Research</span>
                    </div>
                    <div class="hero-image-frame p-3" style="width: 180px; height: 180px; margin: 0 auto;">
                         <img src="{{ asset('image/logo.png') }}" alt="Polindra" class="img-fluid opacity-25" style="max-width: 90px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 2. WRAPPER UNTUK SEMUA KONTEN BAWAH (HIGHLIGHT & LATEST) --}}
<div class="main-content-wrapper">
    {{-- Background Aura (Hanya di area konten) --}}
    <div class="aura-container">
        <div class="aura-glow aura-1"></div>
        <div class="aura-glow aura-2"></div>
        <div class="aura-glow aura-3"></div>
    </div>

    {{-- HIGHLIGHT SECTION --}}
    <section class="top-project-section" style="margin-top: 40px; position: relative; z-index: 20;">
        <div class="container">
            <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border overflow-hidden">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <h3 class="fw-bold mb-0 text-primary">Highlight</h3>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="carousel-nav">
                            <button class="btn btn-outline-primary rounded-circle btn-sm shadow-sm" data-bs-target="#carouselTop" data-bs-slide="prev"><i class="bi bi-chevron-left"></i></button>
                            <button class="btn btn-outline-primary rounded-circle btn-sm shadow-sm ms-2" data-bs-target="#carouselTop" data-bs-slide="next"><i class="bi bi-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

                <div id="carouselTop" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $displayTop = $topProjects->count() > 0 ? $topProjects : $allProjects->take(3);
                            $pathProyek = 'images/proyek/';
                        @endphp
                        @forelse($displayTop as $index => $tp)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row g-4 align-items-center">
                                <div class="col-lg-5">
                                    <div class="rounded-3 overflow-hidden shadow-sm" style="height: 300px;">
                                        @php
                                            $gambarTop = $tp->gambars->first();
                                            $fotoTop = ($gambarTop && file_exists(public_path($pathProyek . $gambarTop->lokasi))) 
                                                       ? asset($pathProyek . $gambarTop->lokasi) 
                                                       : asset($pathProyek . 'defaultimage.png');
                                        @endphp
                                        <img src="{{ $fotoTop }}" class="w-100 h-100 object-fit-cover">
                                    </div>
                                </div>
                                <div class="col-lg-7 p-lg-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-primary-subtle text-primary me-2">Highlight</span>
                                        <small class="text-muted"><i class="bi bi-calendar-event me-1"></i>{{ $tp->created_at->format('Y') }}</small>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-3">{{ $tp->judul }}</h4>
                                    <p class="text-secondary small mb-4 lh-lg" style="text-align: justify;">{{ Str::limit($tp->deskripsi, 250) }}</p>
                                    <a href="{{ url('/repository/' . $tp->repoCode) }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold btn-sm shadow-sm">Pelajari Proyek</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">Belum ada karya unggulan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PEMBATAS JARAK --}}
    <div class="container py-5 text-center">
        <div class="divider-line mx-auto"></div>
    </div>

    {{-- LATEST WORKS SECTION --}}
    <section class="latest-work position-relative" style="z-index: 20; padding-bottom: 100px;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h3 class="fw-bold mb-0">Arsip Riset <span class="text-primary">Terbaru</span></h3>
                    <div class="title-decorator"></div>
                </div>
                <a href="{{ url('/repository') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold bg-white shadow-sm">Lihat Semua</a>
            </div>
            
            <div class="row g-4">
                @foreach($allProjects->take(6) as $p)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm project-card-modern overflow-hidden">
                        {{-- GAMBAR KARTU PROYEK --}}
                        <div class="card-img-container">
                            @php
                                $pathProyek = 'images/proyek/';
                                $gambarItem = $p->gambars->first();
                                $fotoItem = ($gambarItem && file_exists(public_path($pathProyek . $gambarItem->lokasi))) 
                                        ? asset($pathProyek . $gambarItem->lokasi) 
                                        : asset($pathProyek . 'defaultimage.png');
                            @endphp
                            <img src="{{ $fotoItem }}" class="w-100 h-100 object-fit-cover transition-img">
                            <div class="badge-overlay">
                                <span class="badge rounded-pill bg-white text-dark shadow-sm">{{ $p->created_at->format('Y') }}</span>
                            </div>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            {{-- ID & JUMLAH ANGGOTA --}}
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-light text-secondary border rounded-pill">
                                    <i class="bi bi-people-fill me-1"></i>{{ $p->kelompok->count() }} Anggota
                                </span>
                            </div>

                            <h5 class="fw-bold text-dark mb-3 card-title-text">
                                <a href="{{ url('/repository/' . $p->repoCode) }}" class="text-decoration-none text-dark hover-primary">{{ Str::limit($p->judul, 45) }}</a>
                            </h5>
                            <p class="text-muted small mb-4 card-desc-text">
                                {{ Str::limit($p->deskripsi, 85) }}
                            </p>
                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                <span class="small fw-bold text-secondary">Detail Proyek</span>
                                <span class="explore-icon text-primary"><i class="bi bi-arrow-right-circle-fill fs-5"></i></span>
                            </div>
                        </div>
                        <a href="{{ url('/repository/' . $p->repoCode) }}" class="stretched-link"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<style>
    /* 1. HERO FIX */
    .hero-home { z-index: 1; }
    .shape-blob { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.12; z-index: 1; }
    .blob-1 { width: 400px; height: 400px; background: #ffc107; top: -100px; left: -100px; }
    .blob-2 { width: 300px; height: 300px; background: #0d6efd; bottom: -50px; right: -50px; }
    
    .floating-card-1, .floating-card-2 { position: absolute; background: white; padding: 12px 20px; border-radius: 15px; z-index: 10; animation: floatY 5s ease-in-out infinite; }
    .floating-card-1 { top: 15%; right: 0; }
    .floating-card-2 { bottom: 15%; left: 0; animation-delay: -2.5s; }
    .hero-image-frame { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 35px; transform: rotate(12deg); display: flex; align-items: center; justify-content: center; }

    /* 2. MAIN CONTENT WRAPPER & AURA */
    .main-content-wrapper { 
        position: relative; 
        background: #ffffff; 
        border-radius: 40px 40px 0 0; 
        z-index: 10;
        overflow: hidden; /* Menjaga aura tidak keluar jalur */
    }
    .aura-container {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: 1;
        pointer-events: none;
    }
    .aura-glow {
        position: absolute; width: 600px; height: 600px; border-radius: 50%;
        filter: blur(120px); opacity: 0.08;
        animation: auraMove 20s infinite alternate ease-in-out;
    }
    .aura-1 { background: #0d6efd; top: 10%; left: -10%; }
    .aura-2 { background: #ffc107; top: 40%; right: -10%; animation-delay: -5s; }
    .aura-3 { background: #0d6efd; bottom: 5%; left: 5%; animation-delay: -10s; }

    @keyframes auraMove {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(80px, 50px) scale(1.1); }
    }

    /* 3. CARD STYLING */
    .project-card-modern { 
        transition: all 0.4s ease; 
        border-radius: 20px; 
        background: rgba(255,255,255,0.85); 
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0,0,0,0.05) !important;
    }
    .project-card-modern:hover { transform: translateY(-10px); shadow: 0 15px 35px rgba(0,47,108,0.1) !important; }
    
    .card-img-container { height: 190px; overflow: hidden; position: relative; }
    .transition-img { transition: transform 0.6s ease; }
    .project-card-modern:hover .transition-img { transform: scale(1.1); }
    
    .badge-overlay { position: absolute; top: 15px; right: 15px; }
    .card-title-text { min-height: 2.8rem; line-height: 1.4; font-size: 1.05rem; }
    .card-desc-text { min-height: 3rem; }

    /* UTILITIES */
    .divider-line { width: 200px; height: 1px; background: linear-gradient(90deg, transparent, rgba(13,110,253,0.2), transparent); }
    .title-decorator { width: 50px; height: 4px; background: #ffc107; margin-top: 10px; border-radius: 10px; }
    .object-fit-cover { object-fit: cover; }
    @keyframes floatY { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
</style>