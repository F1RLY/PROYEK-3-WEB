@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-folder-plus fs-1 text-primary"></i>
                        <h3 class="fw-bold mt-2">Tambah Proyek Baru</h3>
                        <p class="text-muted">Upload karya/proyek Anda ke repository</p>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ url('/profile/'.$user->kode.'/add-proyek') }}" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Judul Proyek --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Proyek <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul proyek" required>
                        </div>
                        
                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="5" class="form-control" placeholder="Jelaskan tentang proyek Anda..." required></textarea>
                        </div>
                        
                        {{-- Anggota Kelompok --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Anggota Kelompok</label>
                            <div id="anggota-container">
                                <div class="input-group mb-2 anggota-item">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" name="anggota[]" class="form-control" placeholder="Nama anggota 1" value="{{ $user->username }}" readonly>
                                    <button type="button" class="btn btn-outline-danger remove-anggota" style="display: none;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" id="tambah-anggota" class="btn btn-sm btn-outline-primary mt-2">
                                <i class="bi bi-plus-circle"></i> Tambah Anggota
                            </button>
                            <small class="text-muted d-block mt-1">Masukkan nama anggota kelompok (minimal 1, yaitu Anda sendiri)</small>
                        </div>
                        
                        {{-- Dosen Pembimbing --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dosen Pembimbing <span class="text-danger">*</span></label>
                            <select name="dosenId" class="form-select" required>
                                <option value="">Pilih Dosen Pembimbing</option>
                                @foreach($dosen as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama }} ({{ $d->NIP }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Link Demo --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Demo/Website</label>
                            <input type="url" name="link" class="form-control" placeholder="https://...">
                            <small class="text-muted">Opsional, link ke demo atau hosting proyek</small>
                        </div>
                        
                        {{-- Upload File --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">File Laporan (PDF)</label>
                                <input type="file" name="file_laporan" class="form-control" accept=".pdf">
                                <small class="text-muted">Opsional, maksimal 10MB</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">File PPT (Presentasi)</label>
                                <input type="file" name="file_ppt" class="form-control" accept=".ppt,.pptx">
                                <small class="text-muted">Opsional, maksimal 10MB</small>
                            </div>
                        </div>
                        
                        {{-- Gambar Proyek --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar/Foto Proyek</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Opsional, format JPG/PNG, maksimal 2MB</small>
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle"></i> Setelah diupload, proyek Anda akan diverifikasi oleh admin terlebih dahulu.
                        </div>
                        
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary px-4">Upload Proyek</button>
                            <a href="{{ url('/profile/'.$user->kode) }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('tambah-anggota').addEventListener('click', function() {
        var container = document.getElementById('anggota-container');
        var newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 anggota-item';
        newItem.innerHTML = `
            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
            <input type="text" name="anggota[]" class="form-control" placeholder="Nama anggota" required>
            <button type="button" class="btn btn-outline-danger remove-anggota">
                <i class="bi bi-trash"></i>
            </button>
        `;
        container.appendChild(newItem);
        
        newItem.querySelector('.remove-anggota').addEventListener('click', function() {
            newItem.remove();
        });
    });
    
    // Hapus tombol remove untuk anggota pertama
    document.querySelectorAll('.remove-anggota').forEach(btn => {
        if (btn.closest('.anggota-item').querySelector('input').value === '{{ $user->username }}') {
            btn.style.display = 'none';
        } else {
            btn.style.display = 'inline-flex';
        }
    });
</script>
@endsection