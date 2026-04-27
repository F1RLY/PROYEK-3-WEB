@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center p-4">
                    <img src="{{ $user->foto ? asset('image/'.$user->foto) : asset('image/profile-default.png') }}" 
                         class="rounded-circle border border-3 border-primary mb-3" 
                         style="width: 120px; height: 120px; object-fit: cover;">
                    <h4 class="fw-bold">{{ $user->username }}</h4>
                    <span class="badge bg-primary">Mahasiswa</span>
                    <hr>
                    <p class="text-muted mb-1"><i class="bi bi-envelope"></i> {{ $user->email }}</p>
                    <p class="text-muted"><i class="bi bi-key"></i> NIM: {{ $user->kode }}</p>
                    <a href="{{ url('/profile/'.$user->kode.'/edit') }}" class="btn btn-outline-primary mt-3 w-100">
                        <i class="bi bi-pencil"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person-badge text-primary me-2"></i> Detail Akademik</h5>
                    <table class="table table-borderless">
                        <tr><td width="150"><strong>Nama Lengkap</strong></td><td>: {{ $user->username }}</td></tr>
                        <tr><td><strong>NIM</strong></td><td>: {{ $user->kode }}</td></tr>
                        <tr><td><strong>Angkatan</strong></td><td>: {{ $mahasiswa->angkatan ?? '-' }}</td></tr>
                        <tr><td><strong>Kelas</strong></td><td>: {{ strtoupper($mahasiswa->kelas ?? '-') }}</td></tr>
                        <tr><td><strong>Email</strong></td><td>: {{ $user->email }}</td></tr>
                    </table>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0"><i class="bi bi-folder text-primary me-2"></i> Proyek Saya</h5>
                        <a href="{{ url('/profile/'.$user->kode.'/add-proyek') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus"></i> Tambah Proyek
                        </a>
                    </div>
                    <hr>
                    @if(isset($dataMhs['proyek']) && count($dataMhs['proyek']) > 0)
                        @foreach($dataMhs['proyek'] as $proyek)
                            <div class="border-bottom pb-2 mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ url('/repository/'.$proyek->repoCode) }}" class="text-decoration-none">
                                        <i class="bi bi-file-earmark-text"></i> {{ $proyek->judul }}
                                    </a>
                                    <div class="btn-group">
                                        <a href="{{ url('/profile/'.$user->kode.'/proyek/'.$proyek->id.'/edit') }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="confirmDelete('{{ $user->kode }}', '{{ $proyek->id }}', '{{ addslashes($proyek->judul) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center py-3">Belum ada proyek. <a href="{{ url('/profile/'.$user->kode.'/add-proyek') }}">Buat proyek pertama</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(nim, proyekId, judul) {
    if (confirm('Apakah Anda yakin ingin menghapus proyek "' + judul + '"? Data yang dihapus tidak dapat dikembalikan.')) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '/profile/' + nim + '/proyek/' + proyekId + '/delete';
        form.innerHTML = '@csrf <input type="hidden" name="_method" value="DELETE">';
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection