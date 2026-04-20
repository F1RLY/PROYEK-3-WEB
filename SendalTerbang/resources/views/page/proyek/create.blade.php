    <header>
        @include("layouts/header")
    </header>
@section('content')
<div class="container">
    <h3>Tambah Proyek</h3>

    <form action="{{ route('proyek.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Judul Proyek</label>
        <input type="text" name="judul_proyek" class="form-control" required>

        <label>Nama Anggota</label>
        <input type="text" name="nama_anggota" class="form-control" required>

        <label>Dosen Pembimbing</label>
        <input type="text" name="dosen_pembimbing" class="form-control" required>

        <label>Mitra</label>
        <input type="text" name="mitra" class="form-control">

        <label>Angkatan</label>
        <input type="text" name="angkatan" class="form-control">

        <label>Tahun Penerbit</label>
        <input type="number" name="tahun_penerbit" class="form-control" required>

        <label>File Laporan (PDF/ZIP)</label>
        <input type="file" name="file_laporan" class="form-control">

        <label>URL Proyek</label>
        <input type="text" name="url_proyek" class="form-control">

        <label>Foto Proyek</label>
        <input type="file" name="foto_proyek" class="form-control">

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
    <footer>
        @include('layouts/footer')
    </footer>
