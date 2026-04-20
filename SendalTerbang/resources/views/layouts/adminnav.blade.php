<div class="admin-nav">
    <h1 class="admin-header">Admin Page</h1>
    
    <ul>
        <a class="<?= $part == 'dashboard' ? 'active' : '' ?>" href="/admin-dashboard"><li><i class="bi bi-house-door"></i>  Dashboard</li></a>
        <a class="<?= $part == 'kelolaProyek' ? 'active' : '' ?>" href="/admin-kelola-proyek"><li><i class="bi bi-clipboard2-pulse"></i>  Daftar Proyek</li></a>
        <a class="<?= $part == 'kelolaAkun' ? 'active' : '' ?>" href="/admin-kelola-akun"><li><i class="bi bi-person-circle"></i>  Daftar Mahasiswa</li></a>
        <a class="<?= $part == 'kelolDosen' ? 'active' : '' ?>" href="/admin-kelola-dosen"><li><i class="bi bi-person-circle"></i>  Daftar Dosen</li></a>
        <!-- <a class="<?= $part == 'vertifikasi' ? 'active' : '' ?>" href="/admin-vertifikasi"><li><i class="bi bi-clipboard-check"></i>  Vertifikasi Proyek</li></a> -->
        <!-- <a class="<?= $part == 'kelolaDanPenilaian' ? 'active' : '' ?>" href="/admin-kelolaDanPenilaian"><li><i class="bi bi-graph-up"></i>  Kelola dan Penilaian</li></a> -->
    </ul>
    
    <ul>
        <a href="https://chatgpt.com/"><li><i class="bi bi-question-circle"></i>   bantuan</li></a>
        <a href="/"><li><i class="bi bi-box-arrow-right"></i>  Keluar</li></a>
    </ul>
</div>