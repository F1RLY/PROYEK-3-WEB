@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="container py-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 d-inline-block p-3 rounded-4 mb-3">
                            <i class="bi bi-person-plus fs-1 text-primary"></i>
                        </div>
                        <h3 class="fw-bold">Daftar Akun</h3>
                        <p class="text-muted">Bergabung dengan RepoTI</p>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ url('/register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="username" class="form-control" placeholder="Nama lengkap" value="{{ old('username') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NIM</label>
                                <input type="text" name="nim" class="form-control" placeholder="2403xxx" value="{{ old('nim') }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Angkatan</label>
                                <select name="angkatan" class="form-select" required>
                                    <option value="">Pilih Angkatan</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kelas</label>
                                <select name="kelas" class="form-select" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold">
                            <i class="bi bi-person-plus"></i> Daftar
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted">Sudah punya akun? <a href="{{ url('/login') }}" class="text-primary fw-bold">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection