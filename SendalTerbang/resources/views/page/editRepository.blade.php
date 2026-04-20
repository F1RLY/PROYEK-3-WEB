<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --primary: #4f46e5;
        --primary-light: #eef2ff;
        --primary-hover: #4338ca;
        --danger: #ef4444;
        --success: #10b981;
        --bg-body: #f8fafc;
        --text-dark: #0f172a;
        --text-muted: #64748b;
        --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    body { 
        background-color: var(--bg-body); 
        color: var(--text-dark); 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        font-size: 0.95rem; 
    }
    
    .sticky-header { 
        position: sticky; 
        top: 1.5rem; 
        z-index: 1000; 
        background: rgba(255, 255, 255, 0.85); 
        backdrop-filter: blur(10px); 
        padding: 1rem 2rem; 
        border-radius: 1rem; 
        border: 1px solid rgba(226, 232, 240, 0.8); 
        margin-bottom: 2.5rem; 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        box-shadow: var(--card-shadow); 
    }

    .form-section-card { 
        background: #ffffff; 
        border-radius: 1.25rem; 
        border: 1px solid #e2e8f0; 
        padding: 2rem; 
        margin-bottom: 1.5rem; 
        box-shadow: var(--card-shadow); 
    }
    
    .input-label { 
        font-weight: 700; 
        font-size: 0.7rem; 
        text-transform: uppercase; 
        color: var(--text-muted); 
        margin-bottom: 0.6rem; 
        display: block; 
        letter-spacing: 0.05em; 
    }
    
    .custom-input { 
        width: 100%; 
        padding: 0.75rem 1rem; 
        border-radius: 0.75rem; 
        border: 1.5px solid #f1f5f9; 
        background: #f8fafc; 
        transition: all 0.2s ease; 
    }
    
    .custom-input:focus { 
        outline: none; 
        border-color: var(--primary); 
        background: #fff; 
        box-shadow: 0 0 0 4px var(--primary-light); 
    }

    .media-scroll-area { 
        display: flex; 
        gap: 1.25rem; 
        overflow-x: auto; 
        padding: 0.5rem 0.25rem 1.5rem; 
        scrollbar-width: thin; 
    }
    
    .gallery-item, .video-item { 
        width: 240px; 
        flex-shrink: 0; 
        background: #fff; 
        border: 1px solid #e2e8f0; 
        border-radius: 1rem; 
        padding: 0.75rem; 
        position: relative; 
    }
    
    .gallery-item img, .video-item video { 
        width: 100%; 
        height: 140px; 
        object-fit: cover; 
        border-radius: 0.75rem; 
        background: #f1f5f9; 
    }
    
    .gallery-overlay, .video-delete { 
        width: 100%; 
        margin-top: 0.75rem; 
        padding: 0.6rem; 
        border-radius: 0.75rem; 
        border: 1.5px solid #fee2e2; 
        background: #fff5f5; 
        color: var(--danger); 
        font-size: 0.8rem; 
        font-weight: 700; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        cursor: pointer; 
    }

    .gallery-add, .video-add { 
        min-width: 240px; 
        height: 215px; 
        border: 2px dashed #cbd5e1; 
        border-radius: 1rem; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        background: #fff; 
        color: var(--text-muted); 
        cursor: pointer; 
        transition: 0.2s;
    }
    
    .gallery-add:hover, .video-add:hover { 
        border-color: var(--primary); 
        color: var(--primary); 
        background: var(--primary-light); 
    }

    .modal-wrap { 
        display: none; 
        position: fixed; 
        inset: 0; 
        z-index: 9999; 
        background: rgba(15, 23, 42, 0.5); 
        backdrop-filter: blur(8px); 
        align-items: center; 
        justify-content: center; 
        padding: 1.5rem; 
    }
    
    .modal-card { 
        background: white; 
        border-radius: 1.5rem; 
        width: 100%; 
        max-width: 500px; 
        padding: 2.25rem; 
        max-height: 90vh; 
        overflow-y: auto; 
    }
    
    .doc-card-modern { 
        border-radius: 1rem; 
        border: 2px solid #f1f5f9; 
        padding: 1.25rem; 
        transition: 0.3s; 
        position: relative; 
        background: #f8fafc; 
        margin-bottom: 1rem; 
    }
    
    .list-item-modern { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        padding: 1rem 1.25rem; 
        background: #f8fafc; 
        border-radius: 1rem; 
        border: 1px solid #e2e8f0; 
        margin-bottom: 0.75rem; 
    }

    .doc-uploaded-new { 
        border-color: var(--success) !important; 
        background-color: #f0fdf4 !important; 
        transition: all 0.3s ease; 
    }
    
    .file-name.new-selection { 
        color: var(--success) !important; 
        font-weight: 800; 
    }
    
    .badge-new { 
        font-size: 0.65rem; 
        background: var(--success); 
        color: white; 
        padding: 2px 8px; 
        border-radius: 50px; 
        margin-left: 8px; 
        vertical-align: middle; 
    }

    /* STYLING KHUSUS UNTUK PENCARIAN */
    .student-list, .dosen-list {
        max-height: 400px;
        overflow-y: auto;
    }
    
    .student-item-container {
        display: block;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .student-item-container.hidden {
        display: none !important;
    }
    
    /* Pastikan tombol terlihat */
    .student-list button, 
    .dosen-list button {
        display: block !important;
        width: 100%;
    }
</style>

<!-- MODAL TAMBAH MAHASISWA -->
<div class="modal-wrap add-mahasiswa-container">
    <div class="modal-card">
        <h5 class="fw-800 mb-4">Tambah Anggota Tim</h5>
        <input type="text" id="search-mahasiswa" onkeyup="find_mahasiswa(this.value)" class="custom-input mb-3" placeholder="Cari nama atau NIM...">
        <div class="student-list">
            @foreach($mahasiswaList as $mhs)
                <div class="student-item-container">
                    <button type="button" 
                            onclick="addNewMahasiswa('{{ $mhs['nama'] }}', '{{ $mhs['nim'] }}')" 
                            class="student-item w-100 text-start btn btn-light mb-2 p-3 border-0"
                            data-nama="{{ $mhs['nama'] }}"
                            data-nim="{{ $mhs['nim'] }}">
                        <div class="fw-bold">{{ $mhs['nama'] }}</div>
                        <small class="text-muted">{{ $mhs['nim'] }}</small>
                    </button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-light w-100 mt-3 rounded-pill fw-bold" onclick="hide_add_mahasiswa_container()">Batalkan</button>
    </div>
</div>

<!-- MODAL PILIH DOSEN -->
<div class="modal-wrap set-dosen-container">
    <div class="modal-card">
        <h5 class="fw-800 mb-4">Pilih Dosen Pembimbing</h5>
        <input type="text" id="search-dosen" onkeyup="find_dosen(this.value)" class="custom-input mb-3" placeholder="Cari nama dosen...">
        <div class="dosen-list">
            @foreach($dosenList as $index => $dosen)
                <div class="dosen-item-container">
                    <button onclick="set_dosen({{ $index }})" 
                            class="dosen-item w-100 text-start btn btn-light mb-2 p-3 border-0"
                            data-nama="{{ $dosen['nama'] }}">
                        <div class="fw-bold text-primary">{{ $dosen['nama'] }}</div>
                    </button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-light w-100 mt-3 rounded-pill fw-bold" onclick="hide_dosen_list()">Tutup</button>
    </div>
</div>

<!-- FORM UTAMA -->
<div class="container py-5">
    <form action="/repository/{{ $proyek['repoCode'] }}/edit" method="post" enctype="multipart/form-data" id="main-form">
        @csrf
        
        <div id="hidden-inputs-area" hidden>
            <div class="dosen-selected-input">
                @if($dosen)
                    <input type="hidden" name="dosen_selected[]" value="{{ $dosen['kode'] }}">
                    <input type="hidden" name="dosen_selected[]" value="{{ $dosen['nama'] }}">
                @endif

            </div>

            <div class="team-list"></div>
            <div class="delete-mahasiswa-list"></div>
            <div class='images-amount'></div>
            <div class="image-list"></div>
            <div class="image-delete-list"></div>
            <div class='video-amount'></div>
            <div class="video-add-list"></div>
            <div class="video-del-list"></div>
            <div class="laporan-file"></div>
            <div class="ppt-file-input-container"></div>
        </div>
        
        <div class="sticky-header0">
            <a href="/repository/{{ $proyek['repoCode'] }}" class="text-decoration-none text-muted fw-bold small">
                <i class="bi bi-chevron-left me-1"></i> KEMBALI
            </a>
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-800">
                Simpan Perubahan <i class="bi bi-check2-circle ms-1"></i>
            </button>
        </div>

        <div class="row g-4">
            <!-- KOLOM KIRI -->
            <div class="col-lg-7">
                <div class="form-section-card">
                    <h5 class="fw-800 mb-4 text-primary">Detail Utama Proyek</h5>
                    <div class="mb-4">
                        <label class="input-label">Judul Repository</label>
                        <input type="text" name="judul" class="custom-input fw-bold" value="{{ $proyek['judul'] }}">
                    </div>
                    <div class="mb-4">
                        <label class="input-label">Deskripsi Proyek</label>
                        <textarea name="deskripsi" class="custom-input" rows="6">{{ $proyek['deskripsi'] }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="input-label">Link Web / Demo</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white" style="border:none"><i class="bi bi-globe"></i></span>
                            <input type="text" name="link" class="custom-input" style="border-top-left-radius: 0; border-bottom-left-radius: 0;" value="{{ $proyek['link'] }}">
                        </div>
                    </div>
                </div>

                <div class="form-section-card">
                    <h5 class="fw-800 mb-1">Galeri Snapshot</h5>
                    <div class="media-scroll-area gallery-scroll"></div>
                </div>

                <div class="form-section-card">
                    <h5 class="fw-800 mb-1">Demo Video</h5>
                    <div class="media-scroll-area video-scroll"></div>
                </div>
            </div>

            <!-- KOLOM KANAN -->
            <div class="col-lg-5">
                <div class="form-section-card">
                    <h6 class="fw-800 mb-3 text-muted">DOSEN PEMBIMBING</h6>
                    <div id="dosen-pembimbing">
                        <div class="list-item-modern">
                            <div class="dosen-name-selected">
                                 <b>{{ $dosen['nama'] ?? 'Belum dipilih' }}</b>
                            </div>
                            <button type="button" onclick="show_dosen_list()" class="btn btn-sm btn-white border px-3 rounded-pill fw-bold">Ganti</button>
                        </div>
                    </div>
                </div>

                <div class="form-section-card">
                    <h6 class="fw-800 mb-3 text-muted">ANGGOTA TIM</h6>
                    <div id="anggota-list"></div>
                    <button type="button" onclick="show_add_mahasiswa_container()" class="btn btn-primary-light text-primary w-100 rounded-pill btn-sm fw-bold py-2 mt-2">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Anggota
                    </button>
                </div>

                <div class="form-section-card">
                    <h6 class="fw-800 mb-4 text-muted">DOKUMEN PROYEK</h6>
                    <div class="doc-card-modern">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-file-earmark-pdf-fill fs-3 text-danger me-2"></i>
                            <h6 class="fw-bold mb-0 small">Laporan Project</h6>
                        </div>
                        <small class="text-muted laporan-name d-block mb-3 text-truncate">{{ $proyek['file_laporan'] ?? 'Belum ada file' }}</small>
                        <div class="d-flex gap-2">
                            <label class="btn btn-white btn-sm border flex-grow-1 fw-bold rounded-pill">
                                Ganti <input type="file" onchange="handleFile(this, '.laporan-file', 'laporan-file', '.laporan-name', '.laporan-link')" accept="application/pdf" hidden>
                            </label>
                            <a href="{{ asset('document/Laporan/'.$proyek['file_laporan']) }}" class="btn btn-primary btn-sm rounded-pill px-3" target="_blank">Lihat</a>
                        </div>
                    </div>

                    <div class="doc-card-modern">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-file-earmark-slides-fill fs-3 text-warning me-2"></i>
                            <h6 class="fw-bold mb-0 small">Slide Presentasi</h6>
                        </div>
                        <small class="text-muted ppt-name d-block mb-3 text-truncate">{{ $proyek['file_ppt'] ?? 'Belum ada file' }}</small>
                        <div class="d-flex gap-2">
                            <label class="btn btn-white btn-sm border flex-grow-1 fw-bold rounded-pill">
                                Ganti <input type="file" onchange="handleFile(this, '.ppt-file-input-container', 'ppt-file', '.ppt-name', '#view-ppt')" accept=".ppt,.pptx" hidden>
                            </label>
                            <a id="view-ppt" href="{{ asset('document/PPT/'.$proyek['file_ppt']) }}" class="btn btn-primary btn-sm rounded-pill px-3" target="_blank">Lihat</a>
                        </div>
                    </div>
                </div>

                <div class="form-section-card border-danger" style="background: #fffafa; border: 1.5px solid #fee2e2;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px;">
                            <i class="bi bi-exclamation-triangle-fill" style="font-size: 12px;"></i>
                        </div>
                        <h6 class="fw-800 mb-0 text-danger">ZONA BERBAHAYA</h6>
                    </div>
                    
                    <p class="text-muted mb-4" style="font-size: 0.75rem; line-height: 1.5;">
                        Tindakan ini <b>tidak dapat dibatalkan</b>. Seluruh file laporan, gambar galeri, dan data proyek akan dihapus selamanya.
                    </p>

                    <button type="button" onclick="confirmDelete()" class="btn btn-danger w-100 rounded-pill fw-bold btn-sm py-2 shadow-sm">
                        <i class="bi bi-trash3 me-1"></i> Hapus Proyek Secara Permanen
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- FORM DELETE HIDDEN -->
<form id="form-delete-project" action="/repository/{{ $proyek['repoCode'] }}/delete" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<!-- LOAD JAVASCRIPT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// ==========================================
// KONFIGURASI DATA AWAL
// ==========================================
const self_nim = "{{ session('account')['nim'] }}";
let dosen_list = @json($dosenList);
const mahasiswa_list_default = @json($mahasiswaList);
let mahasiswa_old_team_list = @json($proyek['mahasiswa']);
let mahasiswa_new_team_list = [];

let default_images_list = @json($proyek['images']);
let images_list = [];
let images_location = "{{ asset('images/proyek/') }}";
const max_images_amount = 10;

let default_video_list = @json($proyek['videos']);
let newVideoList = [];
let videos_location = "{{ asset('videos/proyek/') }}";
const MAX_VIDEO_AMOUNT = 5;

// ==========================================
// FUNGSI UTAMA - INISIALISASI
// ==========================================
$(document).ready(function() {
    $('#main-form').on('submit', function() {
        const btn = $(this).find('button[type="submit"]');
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Menyimpan...');
    });

    setMahasiswaList();
    show_image_proyek();
    show_new_video_proyek();
    
    // Pastikan modal siap untuk pencarian
    resetSearch();
});

// ==========================================
// FITUR PENCARIAN MAHASISWA (FIXED)
// ==========================================
function find_mahasiswa(keyword) {
    keyword = keyword.toLowerCase().trim();
    console.log("🔍 Mencari mahasiswa dengan keyword:", keyword);
    
    if (keyword === '') {
        $('.student-item-container').removeClass('hidden');
        return;
    }
    
    $('.student-item-container').each(function() {
        const $container = $(this);
        const $button = $container.find('button');
        
        // Ambil semua data yang bisa dicari
        const nama = $button.data('nama') || $button.attr('data-nama') || '';
        const nim = $button.data('nim') || $button.attr('data-nim') || '';
        const namaText = $button.find('.fw-bold').text() || '';
        const nimText = $button.find('small').text() || '';
        
        // Gabungkan semua teks untuk pencarian
        const searchText = (nama + ' ' + nim + ' ' + namaText + ' ' + nimText).toLowerCase();
        
        // Cek apakah keyword ada dalam teks
        const isMatch = searchText.includes(keyword);
        
        console.log(`Item: ${nama} | NIM: ${nim} | Match: ${isMatch}`);
        
        if (isMatch) {
            $container.removeClass('hidden');
        } else {
            $container.addClass('hidden');
        }
    });
}

// ==========================================
// FITUR PENCARIAN DOSEN (FIXED)
// ==========================================
function find_dosen(keyword) {
    keyword = keyword.toLowerCase().trim();
    console.log("🔍 Mencari dosen dengan keyword:", keyword);
    
    if (keyword === '') {
        $('.dosen-item-container').removeClass('hidden');
        return;
    }
    
    $('.dosen-item-container').each(function() {
        const $container = $(this);
        const $button = $container.find('button');
        
        const nama = $button.data('nama') || $button.attr('data-nama') || '';
        const namaText = $button.find('.fw-bold').text() || '';
        
        const searchText = (nama + ' ' + namaText).toLowerCase();
        const isMatch = searchText.includes(keyword);
        
        console.log(`Dosen: ${nama} | Match: ${isMatch}`);
        
        if (isMatch) {
            $container.removeClass('hidden');
        } else {
            $container.addClass('hidden');
        }
    });
}

// ==========================================
// RESET PENCARIAN
// ==========================================
function resetSearch() {
    // Reset pencarian mahasiswa
    $('.student-item-container').removeClass('hidden');
    $('#search-mahasiswa').val('');
    
    // Reset pencarian dosen
    $('.dosen-item-container').removeClass('hidden');
    $('#search-dosen').val('');
}

// ==========================================
// MODAL FUNCTIONS
// ==========================================
function show_add_mahasiswa_container() {
    resetSearch(); // Reset pencarian saat modal dibuka
    $(".add-mahasiswa-container").css('display', 'flex');
    $("body").css("overflow", "hidden");
}

function hide_add_mahasiswa_container() {
    $(".add-mahasiswa-container").hide();
    $("body").css("overflow", "auto");
}

function show_dosen_list() {
    resetSearch(); // Reset pencarian saat modal dibuka
    $(".set-dosen-container").css('display', 'flex');
    $("body").css("overflow", "hidden");
}

function hide_dosen_list() {
    $(".set-dosen-container").hide();
    $("body").css("overflow", "auto");
}

// ==========================================
// FUNGSI MAHASISWA
// ==========================================
function setMahasiswaList() {
    $("#anggota-list").html("");
    $(".team-list").html("");

    showMahasiswaUI(mahasiswa_old_team_list, true);
    showMahasiswaUI(mahasiswa_new_team_list, false);

    mahasiswa_new_team_list.forEach(mhs => {
        $('.team-list').append(`
            <input type='hidden' name='mahasiswa-nim-list[]' value='${mhs.nim}'>
            <input type='hidden' name='mahasiswa-nama-list[]' value='${mhs.nama}'>
        `);
    });
}

function showMahasiswaUI(list, isOld) {
    list.forEach((mhs, index) => {
        let actionBtn = "";
        if (mhs.nim !== self_nim) {
            actionBtn = isOld 
                ? `<button type="button" onclick="deleteOldMahasiswa(${index})" class="btn btn-sm btn-outline-danger rounded-pill">Hapus</button>`
                : `<button type="button" onclick="deleteNewMahasiswa(${index})" class="btn btn-sm btn-danger rounded-pill">Batal</button>`;
        }

        $("#anggota-list").append(`
            <div class="list-item-modern mb-2">
                <div>
                    <div class="fw-bold small">${mhs.nama}</div>
                    <div class="text-muted" style="font-size: 0.75rem">${mhs.nim}</div>
                </div>
                ${actionBtn}
            </div>
        `);
    });
}

function addNewMahasiswa(nama, nim) {
    if (!is_mahasiswa_on_list(nim)) {
        mahasiswa_new_team_list.push({ nama, nim });
        setMahasiswaList();
    }
    hide_add_mahasiswa_container();
}

function deleteNewMahasiswa(index) {
    mahasiswa_new_team_list.splice(index, 1);
    setMahasiswaList();
}

function deleteOldMahasiswa(index) {
    const mhs = mahasiswa_old_team_list[index];
    $('.delete-mahasiswa-list').append(`<input type='hidden' name='mahasiswa-delete-list[]' value='${mhs.nim}'>`);
    mahasiswa_old_team_list.splice(index, 1);
    setMahasiswaList();
}

function is_mahasiswa_on_list(nim) {
    return [...mahasiswa_old_team_list, ...mahasiswa_new_team_list].some(m => m.nim === nim);
}

// ==========================================
// FUNGSI DOSEN
// ==========================================
function set_dosen(index) {
    const dosen = dosen_list[index];
    $(".dosen-selected-input").html(`
        <input type="hidden" name="dosen_selected[]" value="${dosen.kode}">
        <input type="hidden" name="dosen_selected[]" value="${dosen.nama}">
    `);
    $(".dosen-name-selected").html(`<b>${dosen.nama}</b>`);
    hide_dosen_list();
}

// ==========================================
// FUNGSI GALERI GAMBAR
// ==========================================
function show_image_proyek() {
    $(".gallery-scroll").html("");
    
    default_images_list.forEach((img, i) => {
        $(".gallery-scroll").append(`
            <div class="gallery-item">
                <img src="${images_location}/${img.lokasi}">
                <div class="gallery-overlay" onclick="delete_default_image(${i})"><i class="bi bi-trash"></i> Hapus</div>
            </div>
        `);
    });

    images_list.forEach((file, i) => {
        $(".gallery-scroll").append(`
            <div class="gallery-item">
                <img src="${URL.createObjectURL(file)}">
                <div class="gallery-overlay" onclick="delete_new_image(${i})"><i class="bi bi-trash"></i> Batal</div>
            </div>
        `);
    });

    if ((default_images_list.length + images_list.length) < max_images_amount) {
        $(".gallery-scroll").append(`
            <label class="gallery-add">
                <input onchange="add_image_proyek(this)" type="file" accept="image/*" hidden />
                <i class="bi bi-plus-lg fs-2"></i>
                <small class="fw-bold">Tambah Foto</small>
            </label>
        `);
    }
    syncImageInputs();
}

function add_image_proyek(input) {
    if (input.files && input.files[0]) {
        images_list.push(input.files[0]);
        show_image_proyek();
    }
}

function delete_default_image(index) {
    const img = default_images_list[index];
    $(".image-delete-list").append(`<input type="hidden" name="image-delete-list[]" value="${img.imageID}">`);
    default_images_list.splice(index, 1);
    show_image_proyek();
}

function delete_new_image(index) {
    images_list.splice(index, 1);
    show_image_proyek();
}

function syncImageInputs() {
    $(".image-list").html("");
    $(".images-amount").html(`<input type="hidden" name="image-amount" value="${images_list.length}">`);
    images_list.forEach((file, i) => {
        const input = document.createElement('input');
        input.type = 'file';
        input.name = `image-proyek-${i}`;
        input.id = `img-input-${i}`;
        input.hidden = true;
        
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        $(".image-list").append(input);
    });
}

// ==========================================
// FUNGSI VIDEO
// ==========================================
function show_new_video_proyek() {
    $(".video-scroll").html("");
    
    default_video_list.forEach((vid, i) => {
        $(".video-scroll").append(`
            <div class="video-item">
                <video src="${videos_location}/${vid.lokasi}" controls></video>
                <button type="button" onclick="delete_old_video(${i})" class="video-delete">Hapus Video</button>
            </div>
        `);
    });

    newVideoList.forEach((file, i) => {
        $(".video-scroll").append(`
            <div class="video-item">
                <video src="${URL.createObjectURL(file)}" controls></video>
                <button type="button" onclick="delete_new_video(${i})" class="video-delete">Batal</button>
            </div>
        `);
    });

    if ((default_video_list.length + newVideoList.length) < MAX_VIDEO_AMOUNT) {
        $(".video-scroll").append(`
            <label class="video-add">
                <input onchange="add_video_proyek(this)" type="file" accept="video/*" hidden />
                <i class="bi bi-play-btn fs-2"></i>
                <small class="fw-bold">Tambah Video</small>
            </label>
        `);
    }
    syncVideoInputs();
}

function add_video_proyek(input) {
    if (input.files && input.files[0]) {
        newVideoList.push(input.files[0]);
        show_new_video_proyek();
    }
}

function delete_old_video(index) {
    const vid = default_video_list[index];
    $(".video-del-list").append(`<input type="hidden" name="video-del-list[]" value="${vid.videoCode}">`);
    default_video_list.splice(index, 1);
    show_new_video_proyek();
}

function delete_new_video(index) {
    newVideoList.splice(index, 1);
    show_new_video_proyek();
}

function syncVideoInputs() {
    $(".video-add-list").html("");
    $(".video-amount").html(`<input type="hidden" name="video-amount" value="${newVideoList.length}">`);
    newVideoList.forEach((file, i) => {
        const input = document.createElement('input');
        input.type = 'file';
        input.name = `video-proyek-${i}`;
        input.id = `vid-input-${i}`;
        input.hidden = true;

        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        $(".video-add-list").append(input);
    });
}

// ==========================================
// FUNGSI DOKUMEN
// ==========================================
function handleFile(input, container, name, nameDisplay, viewBtnId) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'file';
        hiddenInput.name = name;
        hiddenInput.id = 'id-' + name;
        hiddenInput.hidden = true;

        const dt = new DataTransfer();
        dt.items.add(file);
        hiddenInput.files = dt.files;

        $(container).html(hiddenInput);

        $(nameDisplay).html(file.name + ' <span class="badge-new">SIAP SIMPAN</span>');
        $(nameDisplay).addClass('new-selection');
        $(nameDisplay).closest('.doc-card-modern').addClass('doc-uploaded-new');

        const blobUrl = URL.createObjectURL(file);
        $(viewBtnId).attr('href', blobUrl).attr('target', '_blank');
    }
}

// ==========================================
// FUNGSI DELETE PROJECT
// ==========================================
function confirmDelete() {
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Seluruh data proyek akan hilang dan tidak bisa dikembalikan lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Hapus Permanen!',
        cancelButtonText: 'Batalkan',
        reverseButtons: true,
        backdrop: `rgba(239, 68, 68, 0.1)`,
    }).then((result) => {
        if (result.isConfirmed) {
            const deleteForm = document.getElementById('form-delete-project');
            
            if (deleteForm) {
                Swal.fire({
                    title: 'Sedang Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading() }
                });
                deleteForm.submit();
            } else {
                console.error("Form delete tidak ditemukan di DOM!");
                Swal.fire('Error', 'Sistem tidak menemukan form penghapusan.', 'error');
            }
        }
    })
}
</script>