@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-pencil-square fs-1 text-primary"></i>
                        <h3 class="fw-bold mt-2">Edit Proyek</h3>
                        <p class="text-muted">Perbaiki informasi proyek Anda</p>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ url('/profile/'.$user->kode.'/proyek/'.$proyek->id.'/edit') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Proyek <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $proyek->judul) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="5" class="form-control" required>{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Anggota Kelompok</label>
                            <div id="anggota-container">
                                @foreach($anggotaNama as $index => $nama)
                                <div class="input-group mb-2 anggota-item">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" name="anggota[]" class="form-control" placeholder="Nama anggota" value="{{ $nama }}" required>
                                    <button type="button" class="btn btn-outline-danger remove-anggota">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="tambah-anggota" class="btn btn-sm btn-outline-primary mt-2">
                                <i class="bi bi-plus-circle"></i> Tambah Anggota
                            </button>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dosen Pembimbing <span class="text-danger">*</span></label>
                            <select name="dosenId" class="form-select" required>
                                <option value="">Pilih Dosen Pembimbing</option>
                                @foreach($dosen as $d)
                                    <option value="{{ $d->id }}" {{ $proyek->dosenId == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama }} ({{ $d->NIP }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Demo/Website</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link', $proyek->link) }}" placeholder="https://...">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">File Laporan (PDF)</label>
                                <input type="file" name="file_laporan" class="form-control" accept=".pdf">
                                @if($proyek->file_laporan)
                                    <small class="text-muted">File saat ini: <a href="{{ asset('files/laporan/'.$proyek->file_laporan) }}" target="_blank">Lihat</a></small>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">File PPT</label>
                                <input type="file" name="file_ppt" class="form-control" accept=".ppt,.pptx">
                                @if($proyek->file_ppt)
                                    <small class="text-muted">File saat ini: <a href="{{ asset('files/ppt/'.$proyek->file_ppt) }}" target="_blank">Lihat</a></small>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar Proyek</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            @php
                                $gambar = $proyek->gambars->first();
                            @endphp
                            @if($gambar && file_exists(public_path('images/proyek/'.$gambar->lokasi)))
                                <small class="text-muted">Gambar saat ini: <a href="{{ asset('images/proyek/'.$gambar->lokasi) }}" target="_blank">Lihat</a></small>
                            @endif
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
    
    document.querySelectorAll('.remove-anggota').forEach(btn => {
        btn.addEventListener('click', function() {
            if (document.querySelectorAll('.anggota-item').length > 1) {
                btn.closest('.anggota-item').remove();
            } else {
                alert('Minimal 1 anggota (Anda sendiri)');
            }
        });
    });
</script>
@endsection