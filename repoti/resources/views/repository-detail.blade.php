@extends('layouts.app')

@section('title', $proyek->judul)

@section('content')
<section class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/repository') }}">Repository</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($proyek->judul, 30) }}</li>
        </ol>
    </nav>
    
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="bg-white rounded-4 shadow-sm p-3">
                @php
                    $gambar = $proyek->gambars->first();
                    $foto = $gambar && file_exists(public_path('images/proyek/'.$gambar->lokasi)) 
                        ? asset('images/proyek/'.$gambar->lokasi) 
                        : asset('images/proyek/defaultimage.png');
                @endphp
                <img src="{{ $foto }}" class="w-100 rounded-3">
            </div>
        </div>
        
        <div class="col-lg-7">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <span class="badge bg-primary mb-3">{{ $proyek->created_at->format('Y') }}</span>
                <h1 class="fw-bold mb-3">{{ $proyek->judul }}</h1>
                
                <div class="mb-4">
                    <h6 class="fw-bold"><i class="bi bi-people"></i> Tim Pengembang</h6>
                    <ul class="list-unstyled">
                        @foreach($proyek->kelompok as $anggota)
                        <li class="mb-1">
                            <i class="bi bi-person-check text-primary me-2"></i>
                            {{ $anggota->mahasiswa->user->username ?? 'Mahasiswa' }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold"><i class="bi bi-person-badge"></i> Dosen Pembimbing</h6>
                    <p><i class="bi bi-chalkboard text-primary me-2"></i> {{ $proyek->dosen->nama ?? 'Belum ditentukan' }}</p>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold"><i class="bi bi-file-text"></i> Abstrak</h6>
                    <p class="text-muted" style="text-align: justify;">{{ $proyek->deskripsi }}</p>
                </div>
                
                <div class="d-flex gap-3 flex-wrap">
                    @if($proyek->link)
                    <a href="{{ $proyek->link }}" target="_blank" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-box-arrow-up-right"></i> Lihat Demo
                    </a>
                    @endif
                    
                    @if($proyek->file_laporan)
                    <a href="{{ asset('files/laporan/'.$proyek->file_laporan) }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-file-pdf"></i> Download PDF
                    </a>
                    @endif
                    
                    @if($proyek->file_ppt)
                    <a href="{{ asset('files/ppt/'.$proyek->file_ppt) }}" class="btn btn-outline-success rounded-pill px-4">
                        <i class="bi bi-file-slides"></i> Download PPT
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection