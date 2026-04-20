<div class="container my-5 py-3">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card slim-profile-card shadow border-0">
                <div class="card-body p-4 p-md-4">

                <a href="{{ $prevPage }}" class="btn btn-sm btn-outline-secondary mb-4 align-self-start">
                    <i class="bi bi-arrow-left me-1"></i> Kembali 
                </a>

                    <div class="text-center pt-2 pb-4">
                        <img
                            class="profile-img-compact mb-3"
                            src="https://placehold.co/120x120/007bff/ffffff?text=DSN"
                            alt="Foto Profil Dosen"
                        >

                        <h1 class="h3 fw-bold text-dark mb-0 mt-3">
                            {{ $dosen->nama ?? 'Nama Dosen Tidak Ditemukan' }}
                        </h1>
                        <p class="text-secondary fw-semibold mb-0">
                            NIP: {{ $dosen->NIP ?? 'NIP Tidak Tersedia' }}
                        </p>
                    </div>

                    <hr>

                    <h5 class="mb-3 text-primary-custom fw-bold fs-6 d-flex align-items-center">
                        <i class="bi bi-person-lines-fill me-2"></i> Detail Kontak
                    </h5>

                    <ul class="list-group list-group-flush mb-4 info-list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start info-list-item">
                            <div class="fw-bold text-muted-custom small-caps">Nama Lengkap</div>
                            <span class="text-dark fw-semibold text-end">{{ $dosen->nama ?? 'Nama Dosen' }}</span>
                        </li>
                        
                        <li class="list-group-item d-flex justify-content-between align-items-start info-list-item">
                            <div class="fw-bold text-muted-custom small-caps">Nomor Induk Pegawai</div>
                            <span class="text-dark fw-semibold text-end">{{ $dosen->NIP ?? 'NIP Tidak Tersedia' }}</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Variabel Warna Kustom */
:root {
    --primary-color: #007bff;
    --primary-light: #e9f5ff;
    --secondary-color: #6c757d;
    --dark-color: #212529;
    --muted-color: #6c757d;
    --border-radius-compact: 1rem; /* Lebih kecil */
}

/* Penyesuaian Klasifikasi Warna */
.text-primary-custom { color: var(--primary-color) !important; }
.btn-primary-custom {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}
.btn-primary-custom:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}
.text-muted-custom { color: var(--muted-color) !important; }
.small-caps { font-size: 0.75rem; letter-spacing: 0.5px; text-transform: uppercase; }
.small-text { font-size: 0.9rem; line-height: 1.5; }

/* Gaya Card dan Layout */
.slim-profile-card {
    border-radius: var(--border-radius-compact); /* Lebih kecil */
    transition: box-shadow 0.3s ease-in-out;
}
.slim-profile-card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15) !important;
}

/* Gambar Profil Lebih Kecil */
.profile-img-compact {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--primary-light);
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    display: block;
    margin: 0 auto;
}

/* List Informasi Inti */
.info-list-group {
    border-radius: var(--border-radius-compact);
    overflow: hidden; /* Agar border radius bekerja pada item pertama/terakhir */
    border: 1px solid #dee2e6; /* Memberikan batas pada grup */
}
.info-list-item {
    padding: 0.75rem 1rem !important; /* Padding lebih kecil */
    transition: background-color 0.15s ease;
}
.info-list-item:hover {
    background-color: var(--primary-light);
}

/* Biografi */
.bio-text {
    background-color: #f8f9fa; /* Latar belakang abu-abu sangat muda */
    border-left: 3px solid var(--primary-color); /* Garis tegas tipis di kiri */
}
</style>