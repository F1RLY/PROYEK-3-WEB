@extends('layouts.app')

@section('title', 'Home - Repo TI')

@section('content')
{{-- Hero Section --}}
<section class="hero-section" style="background: linear-gradient(135deg, #1DA1F2 0%, #40C4FF 100%); padding: 80px 0; margin-bottom: -50px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-white">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2">Official Repository Polindra</span>
                <h1 class="display-4 fw-bold mb-3">Eksplorasi <span class="text-warning">Inovasi</span> & Riset Digital</h1>
                <p class="lead mb-4 opacity-75">Pusat dokumentasi dan preservasi karya ilmiah terbaik civitas akademika Politeknik Negeri Indramayu.</p>
                
                {{-- Search Box --}}
                <form action="{{ url('/repository') }}" method="GET" class="bg-white rounded-4 p-2 shadow-lg" style="max-width: 500px;">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control border-0 py-2" placeholder="Cari riset atau proyek..." style="border-radius: 30px 0 0 30px;">
                        <button type="submit" class="btn btn-dark px-4" style="border-radius: 0 30px 30px 0;">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
                
                <div class="row mt-5">
                    <div class="col-4">
                        <h3 class="fw-bold mb-0">{{ $allProjects->count() }}+</h3>
                        <small>Karya Digital</small>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold mb-0">2021-{{ date('Y') }}</h3>
                        <small>Arsip Aktif</small>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold mb-0">{{ \App\Models\User::count() }}+</h3>
                        <small>Mahasiswa</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <div class="bg-white rounded-4 p-4 shadow-lg" style="transform: rotate(5deg);">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" style="max-width: 150px;">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Highlight Section --}}
<section class="container" style="margin-top: 60px;">
    <div class="bg-white rounded-4 shadow-sm p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h3 class="fw-bold mb-0">✨ Highlight Proyek</h3>
            <div>
                <button class="btn btn-outline-primary rounded-circle" id="prevHighlight"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-outline-primary rounded-circle ms-2" id="nextHighlight"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
        
        <div id="highlightCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php $displayTop = $topProjects->count() > 0 ? $topProjects : $allProjects->take(3); @endphp
                @foreach($displayTop as $index => $proyek)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row align-items-center g-4">
                        <div class="col-md-5">
                            <div class="rounded-4 overflow-hidden" style="height: 250px;">
                                @php
                                    $gambar = $proyek->gambars->first();
                                    $foto = $gambar && file_exists(public_path('images/proyek/'.$gambar->lokasi)) 
                                        ? asset('images/proyek/'.$gambar->lokasi) 
                                        : asset('images/proyek/defaultimage.png');
                                @endphp
                                <img src="{{ $foto }}" class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <span class="badge bg-primary mb-2">{{ $proyek->created_at->format('Y') }}</span>
                            <h4 class="fw-bold mb-3">{{ $proyek->judul }}</h4>
                            <p class="text-muted">{{ Str::limit($proyek->deskripsi, 200) }}</p>
                            <a href="{{ url('/repository/'.$proyek->repoCode) }}" class="btn btn-primary rounded-pill px-4">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Latest Projects --}}
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📚 Arsip Riset Terbaru</h3>
        <a href="{{ url('/repository') }}" class="btn btn-outline-primary rounded-pill">Lihat Semua <i class="bi bi-arrow-right"></i></a>
    </div>
    
    <div class="row g-4">
        @foreach($allProjects->take(6) as $proyek)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="position-relative overflow-hidden" style="height: 180px; border-radius: 16px 16px 0 0;">
                    @php
                        $gambar = $proyek->gambars->first();
                        $foto = $gambar && file_exists(public_path('images/proyek/'.$gambar->lokasi)) 
                            ? asset('images/proyek/'.$gambar->lokasi) 
                            : asset('images/proyek/defaultimage.png');
                    @endphp
                    <img src="{{ $foto }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.3s;">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-dark">{{ $proyek->kelompok->count() }} Anggota</span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="fw-bold">{{ Str::limit($proyek->judul, 45) }}</h5>
                    <p class="text-muted small">{{ Str::limit($proyek->deskripsi, 80) }}</p>
                    <a href="{{ url('/repository/'.$proyek->repoCode) }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<style>
.hover-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 16px;
    overflow: hidden;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}
.hover-card:hover img {
    transform: scale(1.05);
}
.object-fit-cover {
    object-fit: cover;
}
</style>
@endsection