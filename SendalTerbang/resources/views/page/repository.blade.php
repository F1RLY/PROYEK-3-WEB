<section class="all-projects py-5 position-relative overflow-hidden" id="projek" style="background: #ffffff; min-height: 100vh;">
    
    {{-- Corak Mesh Gradient --}}
    <div class="mesh-bg-container">
        <div class="mesh-circle circle-blue"></div>
        <div class="mesh-circle circle-cyan"></div>
        <div class="mesh-circle circle-yellow"></div>
    </div>

    <div class="container position-relative" style="z-index: 10;">
        {{-- Header Section --}}
        <div class="row mb-5 justify-content-between align-items-center">
            <div class="col-md-6">
                <span class="badge rounded-pill px-3 py-2 mb-2 shadow-sm" style="background: #002f6c; color: #ffffff; font-size: 0.7rem; letter-spacing: 1px;">REPOSITORY KARYA</span>
                <h2 class="section-title fw-bold display-6 mb-2 text-dark">Eksplorasi <span class="text-primary">Proyek</span></h2>
                <div class="title-divider mb-3"></div>
                <p class="text-secondary fs-6">Temukan inovasi dan karya kreatif mahasiswa dalam ekosistem digital Politeknik Negeri Indramayu.</p>
            </div>
            
            {{-- Search & Filter --}}
            <div class="col-lg-6">
                <div class="search-wrapper-modern p-2">
                    <form action="{{ url('/repository') }}" method="GET" class="row g-2 align-items-center">
                        {{-- Input Group --}}
                        <div class="col-md-8">
                            <div class="input-group border rounded-pill px-2 py-1 bg-white shadow-sm">
                                <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-primary"></i></span>
                                <input type="text" name="q" class="form-control border-0 shadow-none" placeholder="Cari judul proyek..." value="{{ request('q') }}">
                                <button class="btn btn-primary rounded-pill px-4 fw-bold" type="submit">Cari</button>
                            </div>
                        </div>
                        {{-- Filter Tahun --}}
                        <div class="col-md-4">
                            <select name="year" class="form-select filter-select-bold shadow-sm" onchange="this.form.submit()">
                                <option value="">Pilih Tahun</option>
                                @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Grid Project --}}
        <div class="row g-4 d-flex align-items-stretch">
            @forelse($allProjects as $p)
                @php
                    $pathProyek = 'images/proyek/';
                    $imgDefault = 'defaultimage.png';
                    $gambarP = $p->gambars->first();
                    $fotoProyek = ($gambarP && file_exists(public_path($pathProyek . $gambarP->lokasi))) 
                                  ? asset($pathProyek . $gambarP->lokasi) 
                                  : asset($pathProyek . $imgDefault);
                @endphp
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="clean-project-card w-100 d-flex flex-column shadow-sm position-relative overflow-hidden">
                        <div class="card-image-box">
                            <div class="badge-year-modern">{{ $p->created_at->format('Y') }}</div>
                            <img src="{{ $fotoProyek }}" alt="{{ $p->judul }}">
                        </div>
                        <div class="card-body-content p-4 d-flex flex-column flex-grow-1">
                            <h3 class="h6 fw-bold text-dark mb-2 lh-base">{{ Str::limit($p->judul, 55) }}</h3>
                            <p class="text-muted small mb-4 flex-grow-1">{{ Str::limit($p->deskripsi, 90) }}</p>
                            
                            <div class="card-footer-clean d-flex justify-content-between align-items-center pt-3 border-top">
                                <span class="small text-dark fw-bold"><i class="bi bi-people me-1"></i> {{ $p->kelompok->count() }} Anggota</span>
                            </div>
                        </div>
                        <a href="{{ url('/repository/' . $p->repoCode) }}" class="stretched-link"></a>
                    </div>
                </div>
            @empty
                {{-- Tampilan Jika Data Tidak Ada --}}
                <div class="col-12 text-center py-5 my-5">
                    <div class="no-data-icon mb-4">
                        <div class="icon-circle shadow-sm mx-auto">
                            <i class="bi bi-search text-primary"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark">Data yang anda cari tidak ditemukan</h4>
                    <p class="text-muted mx-auto" style="max-width: 500px;">
                        Hasil pencarian untuk 
                        <span class="text-primary fw-bold">"{{ request('q') ?: 'Semua Data' }}"</span> 
                        @if(request('year')) di tahun <span class="fw-bold text-dark">{{ request('year') }}</span> @endif tidak tersedia.
                    </p>
                    <a href="{{ url('/repository') }}" class="btn btn-outline-primary rounded-pill px-4 mt-3 fw-bold">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Semua Pencarian
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    /* 1. MESH BACKGROUND (Sama seperti sebelumnya) */
    .mesh-bg-container {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        z-index: 1; overflow: hidden; pointer-events: none;
    }
    .mesh-circle {
        position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.25;
        animation: meshMove 15s ease-in-out infinite alternate;
    }
    .circle-blue { width: 600px; height: 600px; background: #002f6c; top: -10%; left: -10%; }
    .circle-cyan { width: 500px; height: 500px; background: #0d6efd; bottom: -5%; right: -5%; }
    .circle-yellow { width: 300px; height: 300px; background: #ffc107; top: 30%; right: 10%; opacity: 0.1; }

    @keyframes meshMove {
        0% { transform: translate(0,0) scale(1); }
        100% { transform: translate(50px, 100px) scale(1.1); }
    }

    /* 2. SEARCH WRAPPER */
    .search-wrapper-modern {
        background: rgba(255, 255, 255, 0.5); 
        backdrop-filter: blur(10px);
        border-radius: 20px;
    }
    .filter-select-bold {
        border-radius: 50px !important;
        font-weight: 600;
        padding: 10px 20px !important;
        border: 1px solid #dee2e6;
        cursor: pointer;
    }

    /* 3. CARDS */
    .clean-project-card {
        background: #ffffff; border-radius: 20px; 
        border: 1px solid rgba(0,0,0,0.05); transition: all 0.3s ease;
    }
    .clean-project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 47, 108, 0.15) !important;
    }
    .card-image-box { height: 200px; overflow: hidden; position: relative; }
    .card-image-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s ease; }
    .clean-project-card:hover .card-image-box img { transform: scale(1.1); }
    
    .badge-year-modern {
        position: absolute; top: 12px; left: 12px; z-index: 2;
        background: #002f6c; color: white; padding: 4px 12px;
        border-radius: 8px; font-size: 0.7rem; font-weight: 700;
    }
    .repo-id-tag {
        background: #f0f7ff; color: #0d6efd; padding: 3px 10px;
        border-radius: 6px; font-size: 0.7rem; font-weight: 800;
    }

    /* 4. EMPTY STATE */
    .icon-circle {
        width: 100px; height: 100px; background: #f8f9fa;
        border-radius: 50%; display: flex; align-items: center;
        justify-content: center; font-size: 2.5rem; border: 1px solid #dee2e6;
    }
    .no-data-icon { animation: bounce 2s infinite ease-in-out; }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .title-divider { width: 50px; height: 5px; background: #0d6efd; border-radius: 10px; }
</style>