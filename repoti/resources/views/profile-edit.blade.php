@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-center mb-4">Edit Profil</h4>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ url('/profile/'.$user->kode.'/edit') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="text-center mb-3">
                            <img src="{{ $user->foto ? asset('image/'.$user->foto) : asset('image/profile-default.png') }}" 
                                 class="rounded-circle border border-3 border-primary" 
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Angkatan</label>
                                <select name="angkatan" class="form-select" required>
                                    <option value="2021" {{ ($mahasiswa->angkatan ?? '') == '2021' ? 'selected' : '' }}>2021</option>
                                    <option value="2022" {{ ($mahasiswa->angkatan ?? '') == '2022' ? 'selected' : '' }}>2022</option>
                                    <option value="2023" {{ ($mahasiswa->angkatan ?? '') == '2023' ? 'selected' : '' }}>2023</option>
                                    <option value="2024" {{ ($mahasiswa->angkatan ?? '') == '2024' ? 'selected' : '' }}>2024</option>
                                    <option value="2025" {{ ($mahasiswa->angkatan ?? '') == '2025' ? 'selected' : '' }}>2025</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelas</label>
                                <select name="kelas" class="form-select" required>
                                    <option value="A" {{ ($mahasiswa->kelas ?? '') == 'a' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ ($mahasiswa->kelas ?? '') == 'b' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ ($mahasiswa->kelas ?? '') == 'c' ? 'selected' : '' }}>C</option>
                                    <option value="D" {{ ($mahasiswa->kelas ?? '') == 'd' ? 'selected' : '' }}>D</option>
                                </select>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        <h5 class="fw-bold mb-3">Ganti Password (Opsional)</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>
                        
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                            <a href="{{ url('/profile/'.$user->kode) }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection