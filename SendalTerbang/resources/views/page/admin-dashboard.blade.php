<?php

use App\Http\Controllers\mahasiswaController;
use App\Models\proyek;

$jumlah_proyek = count($proyek);
$proyek_ver = proyek::where("verifikasi", true)->get();
$jumlah_proyek_tervertivikasi = count($proyek_ver);

?>

<style>
    .stats-section {
    padding: 32px;
    background: #ffffff;
}

.stats-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #1f2937;
}

.stats-grid {
    display: flex;
    gap: 24px;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.stats-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 180px;
    height: 140px;
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    text-decoration: none;
    color: #1f2937;
    transition: 0.25s;
}

.stats-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.10);
}

.stats-label {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 4px;
}

.stats-value {
    font-size: 20px;
    font-weight: 600;
    margin-top: 8px;
    color: #2563eb;
}

/* Responsive */
@media (max-width: 640px) {
    .stats-grid {
        gap: 16px;
        justify-content: center;
    }

    .stats-card {
        width: 140px;
        height: 120px;
    }
}

</style>

<div class="stats-section">
    <h2 class="stats-title">Project</h2>

    <div class="stats-grid">

        <a href="#" class="stats-card">
            <span class="stats-label">Project</span>
            <span class="stats-value">{{ $proyekAmount }}</span>
        </a>

        <a href="#" class="stats-card">
            <span class="stats-label">Mahasiswa</span>
            <span class="stats-value">{{ count($mahasiswa) }}</span>
        </a>

        <a href="#" class="stats-card">
            <span class="stats-label">Verifikasi</span>
            <span class="stats-value">{{ count($proyek_ver) }}</span>
        </a>

    </div>
</div>


@include("page.admin-kelolaProyek", [$proyek])

@include("page.admin-kelolaAkun", [$mahasiswa])