@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="container py-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 d-inline-block p-3 rounded-4 mb-3">
                            <i class="bi bi-box-arrow-in-right fs-1 text-primary"></i>
                        </div>
                        <h3 class="fw-bold">Login</h3>
                        <p class="text-muted">Masuk ke akun RepoTI Anda</p>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ url('/login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted">Belum punya akun? <a href="{{ url('/register') }}" class="text-primary fw-bold">Daftar Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection