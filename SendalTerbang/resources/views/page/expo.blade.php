<style>
    .stand-card {
        background: white;
        border-radius: 1.5rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .stand-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: #4f46e5;
    }
    .stand-banner {
        width: 100%;
        height: 160px;
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 1.2rem;
        text-align: center;
        padding: 1rem;
    }
    .badge-stand {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(5px);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-800 mb-1">Gallery Stand Expo</h2>
            <p class="text-muted mb-0">Jelajahi karya inovatif mahasiswa dan berikan penilaian terbaikmu.</p>
        </div>
        <div class="bg-primary-light p-3 rounded-4 text-primary text-center">
            <h4 class="fw-800 mb-0">{{ count($proyekList) }}</h4>
            <small class="fw-bold" style="font-size: 0.6rem;">TOTAL STAND</small>
        </div>
    </div>

    <div class="row g-4">
        @foreach($proyekList as $p)
        <div class="col-md-6 col-lg-4">
            <div class="stand-card position-relative">
                <div class="badge-stand">STAND #{{ $loop->iteration }}</div>
                
                <div class="stand-banner">
                    {{ Str::limit($p->judul, 40) }}
                </div>

                <div class="p-4 flex-grow-1 d-flex flex-column">
                    <h5 class="fw-800 mb-2">{{ $p->judul }}</h5>
                    <p class="text-muted small mb-4 flex-grow-1">
                        {{ Str::limit($p->deskripsi, 100) }}
                    </p>

                    <div class="d-flex gap-2 mt-auto">
                        <a href="/repository/{{ $p->repoCode }}" class="btn btn-light border flex-grow-1 rounded-pill fw-bold btn-sm py-2">
                            <i class="bi bi-eye me-1"></i> Detail
                        </a>
                        
                        <a href="/expo/penilaian/{{ $p->repoCode }}" class="btn btn-primary flex-grow-1 rounded-pill fw-bold btn-sm py-2">
                            <i class="bi bi-star-fill me-1"></i> Beri Nilai
                        </a>
                    </div>
                </div>
                
                <div class="px-4 pb-3 border-top pt-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 25px; height: 25px; font-size: 0.7rem;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <span class="text-muted fw-bold" style="font-size: 0.75rem;">{{ count($p->mahasiswa ?? []) }} Anggota</span>
                        </div>
                        <span class="badge bg-light text-dark border rounded-pill small" style="font-size: 0.65rem;">{{ $p->repoCode }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>