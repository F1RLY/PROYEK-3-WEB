
    <header>
        @include("layouts/header")
    </header>

<div class="container-proyek">
    <h3>Daftar Proyek</h3>

    <a href="{{ route('proyek.create') }}" class="btn-add" style="text-decoration: none">
        + Tambah Proyek
    </a>


    <table class="table table-bordered table-proyek">
        <tr>
            <th>Judul</th>
            <th>Anggota</th>
            <th>Dosen</th>
            <th>Tahun</th>
            <th>Status</th>
        </tr>

        @foreach ($proyek as $item)
        <tr>
            <td>{{ $item->judul_proyek }}</td>
            <td>{{ $item->nama_anggota }}</td>
            <td>{{ $item->dosen_pembimbing }}</td>
            <td>{{ $item->tahun_penerbit }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <a href="{{ route('proyek.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

    <footer>
        @include('layouts/footer')
    </footer>

    <style>
/* Container khusus halaman proyek */
.container-proyek {
    width: 90%;
    max-width: 950px;
    margin: 40px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

/* Judul halaman */
.container-proyek h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #333;
}

/* Tombol Tambah Proyek */
.container-proyek .btn-add {
    display: inline-block;
    background: #3a6df0;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    margin-bottom: 15px;
    transition: 0.2s;
}

.container-proyek .btn-add:hover {
    background: #2c53c4;
    color: white;
}

/* Tabel khusus proyek */
.table-proyek {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

/* Header tabel */
.table-proyek th {
    background: #3a6df0;
    color: white;
    padding: 12px;
    font-weight: 600;
}

/* Isi tabel */
.table-proyek td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

/* Hover row */
.table-proyek tr:hover td {
    background: #f3f6ff;
}

/* Tombol edit pada tabel proyek */
.table-proyek .btn-warning {
    background: #ffca2c !important;
    border: none !important;
}

.table-proyek .btn-warning:hover {
    background: #e0b324 !important;
}
</style>
