<style>
    .profile-card-soft {
        background-color: #ffffff; 
        border: 2px solid #e9ecef; 
    }
    .card-body-compact {
        padding: 1.5rem !important;
    }
    .detail-item {
        border-bottom: 1px solid #dee2e6;
        padding: 0.8rem 0; 
    }
    .detail-item:last-child {
        border-bottom: none;
    }
    .repo-link {
        box-shadow: none;
        border: 1px solid #e9ecef;
    }
    .repo-link:hover {
        background-color: #f8f9fa !important;
        border-color: #0d6efd;
    }
    .social-link-item {
        transition: all 0.2s;
        padding: 0.75rem !important; 
    }
    .social-link-item:hover {
        background-color: #f1f3f5;
        transform: translateY(-2px);
    }
    .social-icon {
        color: #6c757d; 
    }
    .repo-scroll-box {
        max-height: 450px;
        overflow-y: auto;
    }
</style>

@php
    // Ambil data user login untuk info dasar
    $userAuth = Auth::user();
    
    // Ambil data mahasiswa dari DB (untuk angkatan & kelas)
    $mhsData = \App\Models\mahasiswa::where('userID', $userAuth->id)->first();

    // Logika Sosmed: Ambil data langsung dari tabel mahasiswa_sosial_media
    $dbSocials = [];
    if ($mhsData) {
        $dbSocials = \App\Models\sosialMediaMahasiswa::where('mahasiswa_id', $mhsData->id)
                    ->pluck('link', 'sosial_media_id')
                    ->toArray();
    }

    $platforms = [
        1 => ['name' => 'Instagram', 'icon' => 'instagram'],
        2 => ['name' => 'Facebook', 'icon' => 'facebook'],
        3 => ['name' => 'LinkedIn', 'icon' => 'linkedin'],
        4 => ['name' => 'TikTok', 'icon' => 'tiktok'],
    ];
@endphp

<div class="container my-5 profile-page-bg">
    <div class="row g-4">
        
        {{-- KOLOM KIRI: INFO AKADEMIK --}}
        <div class="col-lg-8">
            <div class="card p-4 h-100 shadow-sm profile-card-soft">
                <div class="card-body card-body-compact">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="{{ url('/') }}" class="text-decoration-none fw-medium text-muted">
                            <i class="bi bi-arrow-left-short"></i> Kembali ke Beranda
                        </a>
                        {{-- Menggunakan NIM dari Auth --}}
                        <a href="{{ url('profile/'.$userAuth->kode.'/edit') }}" class="btn btn-sm btn-outline-primary fw-medium">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profil
                        </a>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4 border-bottom pb-3"> 
                        <img class="profile-avatar me-4 rounded-circle border border-primary border-3 p-1"
                            src="{{ $userAuth->foto ? asset('image/'.$userAuth->foto) : asset('image/profile-default.png') }}"
                            alt="Avatar"
                            style="width: 80px; height: 80px; object-fit: cover;">
                        
                        <div>
                            <h3 class="mb-0 fw-bold text-dark">{{ $userAuth->username }}</h3> 
                            <span class="badge bg-light text-primary border border-primary">Mahasiswa Aktif</span>
                        </div>
                    </div>

                    <h5 class="mb-3 text-primary fw-semibold"><i class="bi bi-person-badge me-2"></i> Detail Akademik</h5> 
                    <div class="list-unstyled">
                        <div class="detail-item d-flex align-items-center">
                            <i class="bi bi-file-earmark-person-fill text-secondary me-3 h5 mb-0"></i>
                            <div>
                                <small class="text-uppercase text-muted fw-bold d-block">Nama Lengkap</small>
                                <p class="h6 mb-0 text-dark">{{ $userAuth->username }}</p>
                            </div>
                        </div>

                        <div class="detail-item d-flex align-items-center">
                            <i class="bi bi-key-fill text-secondary me-3 h5 mb-0"></i>
                            <div>
                                <small class="text-uppercase text-muted fw-bold d-block">Nomor Induk Mahasiswa (NIM)</small>
                                <p class="h6 mb-0 fw-bold text-dark">{{ $userAuth->kode }}</p>
                            </div>
                        </div>

                        <div class="detail-item d-flex align-items-center">
                            <i class="bi bi-calendar-check-fill text-secondary me-3 h5 mb-0"></i> 
                            <div>
                                <small class="text-uppercase text-muted fw-bold d-block">Angkatan Kuliah</small>
                                <p class="h6 mb-0 text-dark">{{ $mhsData->angkatan ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="detail-item d-flex align-items-center">
                            <i class="bi bi-door-open-fill text-secondary me-3 h5 mb-0"></i>
                            <div>
                                <small class="text-uppercase text-muted fw-bold d-block">Kelas</small>
                                <p class="h6 mb-0 text-dark">{{ $mhsData->kelas ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: SOSMED & PROYEK --}}
        <div class="col-lg-4 d-flex flex-column">
            
            {{-- SEKSI SOSIAL MEDIA --}}
            <div class="card p-4 shadow-sm profile-card-soft mb-4">
                <h5 class="mb-3 text-primary fw-semibold"><i class="bi bi-share-fill me-2"></i> Sosial Media</h5>
                <hr class="mt-0 mb-3"> 
                
                <div class="row g-2"> 
                    @php $hasSocial = false; @endphp
                    @foreach ($platforms as $id => $info)
                        @if(!empty($dbSocials[$id]))
                            @php $hasSocial = true; @endphp
                            <div class="col-12">
                                <a href="{{ $dbSocials[$id] }}" target="_blank" class="text-decoration-none text-dark social-link-item d-flex align-items-center rounded border">
                                    <i class="bi bi-{{ $info['icon'] }} me-3 h5 mb-0 social-icon"></i> 
                                    <div class="overflow-hidden">
                                        <small class="text-uppercase text-muted fw-bold d-block">{{ $info['name'] }}</small>
                                        <p class="mb-0 fw-medium text-truncate small">{{ $dbSocials[$id] }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                    @if(!$hasSocial)
                        <div class="col-12 text-center py-2">
                            <small class="text-muted italic text-center">Belum ada tautan sosial media.</small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- SEKSI DAFTAR PROYEK (Lengkap dengan anggota kelompok) --}}
            <div class="card p-4 shadow-sm profile-card-soft flex-grow-1">
                <h5 class="card-title mb-3 fw-semibold">📚 Daftar Proyek</h5>
                <p class="text-muted small">Proyek pribadi dan kelompok.</p>
                <hr class="mt-0 mb-3"> 
                
                <div class="list-group repo-scroll-box">
                    @if( count($dataMhs['proyek']) > 0)
                        @foreach ($dataMhs['proyek'] as $proyek)
                            <a href="{{ url('repository/'.$proyek['repoCode']) }}" 
                                class="list-group-item d-flex justify-content-between align-items-center mb-2 rounded-2 p-3 repo-link">
                                <div class="overflow-hidden me-2">
                                    <span class="fw-medium text-dark d-block text-truncate">{{ $proyek["judul"] }}</span>                                </div>
                                <i class="bi bi-chevron-right text-primary"></i>
                            </a>
                        @endforeach
                    @else
                        <div class="alert alert-light text-center border-0 py-4">
                            <i class="bi bi-folder2-open h2 text-muted d-block mb-2"></i>
                            <small class="text-muted">Tidak ada proyek ditemukan.</small>
                        </div>
                    @endif
                </div>

                <a href="{{ url('/profile/'.$userAuth->kode.'/add-proyek') }}" class="btn btn-primary mt-4 w-100 fw-bold">
                    <i class="bi bi-plus-circle me-2"></i> Buat Proyek Baru
                </a>
            </div>

        </div>
    </div>
</div>