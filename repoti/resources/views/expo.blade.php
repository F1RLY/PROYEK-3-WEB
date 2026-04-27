@extends('layouts.app')

@section('title', 'IT Project Expo')

@section('content')
<section class="container py-5">
    <div class="text-center mb-5">
        <div class="bg-primary bg-opacity-10 d-inline-block p-3 rounded-4 mb-3">
            <i class="bi bi-emoji-events fs-1 text-primary"></i>
        </div>
        <h1 class="fw-bold">IT Project <span class="text-primary">Expo 2024</span></h1>
        <p class="text-muted">Pameran karya terbaik mahasiswa Politeknik Negeri Indramayu</p>
    </div>
    
    <div class="row g-4">
        @forelse($expoProjects as $proyek)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm expo-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                            <i class="bi bi-award fs-3 text-primary"></i>
                        </div>
                        <span class="badge bg-warning text-dark">Featured</span>
                    </div>
                    <h5 class="fw-bold mb-2">{{ Str::limit($proyek->judul, 40) }}</h5>
                    <p class="text-muted small">{{ Str::limit($proyek->deskripsi, 100) }}</p>
                    <div class="mt-3">
                        <a href="{{ url('/repository/'.$proyek->repoCode) }}" class="btn btn-primary rounded-pill w-100">
                            Lihat Proyek <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-calendar-x fs-1 text-muted"></i>
            <p class="text-muted mt-3">Belum ada proyek Expo</p>
        </div>
        @endforelse
    </div>
</section>

<style>
.expo-card {
    transition: transform 0.3s;
    border-radius: 20px;
}
.expo-card:hover {
    transform: translateY(-5px);
}
</style>
@endsection