@extends('layouts.app')

@section('title', 'Repository Proyek')

@section('content')
<section class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Repository <span class="text-primary">Proyek</span></h1>
        <p class="text-muted">Temukan berbagai proyek inovatif mahasiswa Polindra</p>
        <div class="mx-auto" style="width: 60px; height: 4px; background: #1DA1F2; border-radius: 10px;"></div>
    </div>
    
    {{-- Search --}}
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <form action="{{ url('/repository') }}" method="GET" class="bg-white rounded-4 p-2 shadow-sm">
                <div class="row g-2">
                    <div class="col-10">
                        <input type="text" name="q" class="form-control border-0 py-2" placeholder="Cari judul proyek..." value="{{ request('q') }}">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3"><i class="bi bi-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Results --}}
    <div class="row g-4">
        @forelse($proyek as $p)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="position-relative overflow-hidden" style="height: 180px; border-radius: 16px 16px 0 0;">
                    @php
                        $gambar = $p->gambars->first();
                        $foto = $gambar && file_exists(public_path('images/proyek/'.$gambar->lokasi)) 
                            ? asset('images/proyek/'.$gambar->lokasi) 
                            : asset('images/proyek/defaultimage.png');
                    @endphp
                    <img src="{{ $foto }}" class="w-100 h-100 object-fit-cover">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-primary">{{ $p->created_at->format('Y') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="fw-bold">{{ Str::limit($p->judul, 50) }}</h5>
                    <p class="text-muted small mt-2">{{ Str::limit($p->deskripsi, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted"><i class="bi bi-people"></i> {{ $p->kelompok->count() }} Anggota</small>
                        <a href="{{ url('/repository/'.$p->repoCode) }}" class="btn btn-sm btn-outline-primary rounded-pill">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-3">Belum ada proyek ditemukan</p>
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $proyek->links() }}
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
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}
.object-fit-cover {
    object-fit: cover;
}
</style>
@endsection