<style>
    :root {
        --accent-color: #6366f1;
        --surface-1: #ffffff;
        --surface-2: #fcfcfd;
        --text-main: #0f172a;
        --text-sub: #64748b;
    }

    body { 
        background-color: #f8fafc; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        color: var(--text-main);
    }

    /* --- POP-UP PROFILE --- */
    .detail-mahasiswa-container {
        position: fixed; top: 0; left: 0; width: 100%; height: 100vh;
        z-index: 2000; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(12px);
        display: none; align-items: center; justify-content: center; padding: 20px;
    }
    .card-profile { 
        background: white; border-radius: 32px; padding: 35px; width: 100%; max-width: 480px; 
        box-shadow: 0 40px 100px -20px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.5);
    }
    .m-extra-info {
        display: grid; grid-template-columns: 1fr 1fr; gap: 15px;
        background: #f1f5f9; padding: 15px; border-radius: 20px; margin: 20px 0;
    }

    /* --- HERO SECTION --- */
    .hero-minimalist {
        padding: 60px 0 40px;
        background: radial-gradient(circle at top right, #eef2ff, transparent);
    }
    .project-category {
        display: inline-block; padding: 6px 16px; background: var(--accent-color);
        color: white; border-radius: 100px; font-size: 11px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px;
    }

    /* --- GRID SYSTEM --- */
    .showcase-grid {
        display: grid; grid-template-columns: repeat(12, 1fr); gap: 25px; margin-top: -30px;
    }

    .card-base {
        background: var(--surface-1); border-radius: 28px; border: 1px solid #e2e8f0;
        padding: 30px; transition: all 0.3s ease;
    }

    /* --- MEDIA CONTAINERS --- */
    .video-showcase {
        grid-column: span 8; background: #000; border-radius: 28px;
        overflow: hidden; height: 380px; position: relative;
    }

    .gallery-showcase { grid-column: span 12; background: #f1f5f9; }
    
    .gallery-container {
        height: 380px; background: #fff; border-radius: 20px;
        overflow: hidden; position: relative; border: 1px solid #e2e8f0;
    }

    .track-container { 
        display: flex; height: 100%; 
        transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1); 
    }

    .item-media { 
        min-width: 100%; height: 100%; display: flex; 
        align-items: center; justify-content: center; background-color: #f8fafc;
    }

    .item-media img { width: 100%; height: 100%; object-fit: contain; padding: 15px; }
    .item-media video { width: 100%; height: 100%; object-fit: contain; }

    /* --- EMPTY STATE STYLE --- */
    .empty-placeholder {
        display: flex; flex-direction: column; align-items: center; 
        justify-content: center; width: 100%; height: 100%; 
        color: #94a3b8; background: #f8fafc; text-align: center;
    }
    .empty-placeholder i { font-size: 3rem; margin-bottom: 10px; opacity: 0.5; }

    /* --- NAVIGATION --- */
    .float-nav { position: absolute; bottom: 20px; right: 20px; display: flex; gap: 8px; z-index: 10; }
    .btn-nav {
        width: 42px; height: 42px; border-radius: 14px; border: none;
        background: white; color: black; display: flex; align-items: center;
        justify-content: center; font-size: 18px; box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        transition: 0.2s;
    }
    .btn-nav:hover { background: var(--accent-color); color: white; transform: translateY(-2px); }

    .info-showcase { grid-column: span 4; }
    .team-section { grid-column: span 7; }
    .file-section { grid-column: span 5; }

    /* --- CARDS & BUTTONS --- */
    .contrib-card {
        display: flex; align-items: center; gap: 12px; padding: 12px;
        border-radius: 20px; background: #f8fafc;
        width: 100%; text-align: left; transition: 0.3s; border: 1px solid transparent;
    }
    .contrib-card:hover { transform: translateY(-3px); background: white; border-color: var(--accent-color); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }

    .file-btn {
        display: flex; align-items: center; justify-content: space-between;
        padding: 15px 20px; border-radius: 16px; background: #fff; border: 1px solid #e2e8f0;
        text-decoration: none; color: inherit; margin-bottom: 10px; transition: 0.2s; font-size: 14px;
    }
    .file-btn:hover { border-color: #ef4444; color: #ef4444; background: #fff5f5; }

    @media (max-width: 1100px) {
        .video-showcase, .info-showcase, .team-section, .file-section { grid-column: span 12; }
        .video-showcase, .gallery-container { height: 300px; }
    }

    /* --- ENHANCED FILE SECTION --- */
.file-section .card-base {
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

/* Garis aksen di atas card */
.file-section .card-base::before {
    content: "";
    position: absolute;
    top: 0; left: 0; width: 100%; height: 4px;
}

.file-btn {
    display: flex;
    align-items: center;
    padding: 18px 22px;
    border-radius: 20px;
    background: white;
    border: 1px solid #f1f5f9;
    text-decoration: none;
    color: var(--text-main);
    margin-bottom: 15px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}

.file-btn:hover {
    transform: translateX(8px);
    background: #ffffff;
    border-color: var(--accent-color);
    box-shadow: 0 15px 30px -5px rgba(99, 102, 241, 0.1);
    color: var(--accent-color);
}

/* Icon Styling */
.file-icon-box {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 15px;
    transition: 0.3s;
}

/* Warna Spesifik untuk PDF */
.pdf-bg { background: #fee2e2; color: #ef4444; }
.file-btn:hover .pdf-bg { background: #ef4444; color: white; }

/* Warna Spesifik untuk PPT */
.ppt-bg { background: #fef3c7; color: #f59e0b; }
.file-btn:hover .ppt-bg { background: #f59e0b; color: white; }

.file-info {
    flex-grow: 1;
}

.file-name {
    display: block;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 2px;
}

.file-size {
    display: block;
    font-size: 11px;
    color: #94a3b8;
}

.download-cloud {
    font-size: 1.2rem;
    opacity: 0.3;
    transition: 0.3s;
}

.file-btn:hover .download-cloud {
    opacity: 1;
    transform: translateY(3px);
}
</style>

<div class="detail-mahasiswa-container" id="panelMahasiswa">
    <div class="card-profile">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('image/profile-default.png') }}" id="m-foto" class="rounded-circle" width="70" height="70" style="object-fit: cover;">
                <div>
                    <h5 class="fw-bold mb-0" id="m-nama">Nama</h5>
                    <p class="text-muted small mb-0" id="m-email">email@student.com</p>
                </div>
            </div>
            <button onclick="hideMahasiswa()" class="btn-close"></button>
        </div>
        <div class="m-extra-info">
            <div>
                <p class="text-muted small fw-bold mb-0 text-uppercase">NIM</p>
                <span id="m-nim" class="small fw-bold">-</span>
            </div>
            <div>
                <p class="text-muted small fw-bold mb-0 text-uppercase">Kelas / Angkatan</p>
                <span id="m-kelas-angkatan" class="small fw-bold">-</span>
            </div>
        </div>
        <div class="mb-3">
            <p class="small fw-bold text-uppercase text-muted mb-2">Social Media</p>
            <div id="m-sosmed" class="d-flex flex-wrap gap-2"></div>
        </div>
        <div>
            <p class="small fw-bold text-uppercase text-muted mb-2">Other Projects</p>
            <div id="m-proyek"></div>
        </div>
    </div>
</div>

<div class="hero-minimalist">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <a href="{{ $prevPage }}" class="btn btn-outline-dark btn-sm rounded-pill mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
                <br>
                <span class="project-category">Project Repository</span>
                <h1 class="display-5 fw-bolder mb-3">{{ $proyek["judul"] }}</h1>
                <div class="d-flex gap-2">
                    @if ($proyek["link"] != "")
                        <a class="btn btn-dark rounded-pill px-4" href="{{ $proyek["link"] }}" target="_blank">Kunjungi Web</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="p-3 border-start border-2">
                    <p class="text-muted small text-uppercase fw-bold mb-1">Dosen Pembimbing</p>
                    <h6 class="fw-bold mb-0">{{ $dosen ?? 'TBA' }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="showcase-grid">
        <div class="video-showcase">
            @if(count($proyek['videos']) > 0)
                <div class="track-container video-track">
                    @foreach($proyek['videos'] as $vd)
                        <div class="item-media">
                            <video src="{{ asset('videos/proyek/'.$vd['lokasi']) }}" controls></video>
                        </div>
                    @endforeach
                </div>
                @if(count($proyek['videos']) > 1)
                <div class="float-nav">
                    <button onclick="moveSlider('video', -1)" class="btn-nav"><i class="bi bi-chevron-left"></i></button>
                    <button onclick="moveSlider('video', 1)" class="btn-nav"><i class="bi bi-chevron-right"></i></button>
                </div>
                @endif
            @else
                <div class="empty-placeholder">
                    <i class="bi bi-play-circle"></i>
                    <p class="small mb-0">Video demonstrasi belum tersedia</p>
                </div>
            @endif
        </div>

        <div class="info-showcase">
            <div class="card-base h-100">
                <h4 class="fw-bold mb-3">Ringkasan Project</h4>
                <p class="text-sub small" style="white-space: pre-wrap; line-height: 1.6;">{{ $proyek["deskripsi"] }}</p>
                @if ($isMyProyek)
                    <a href="{{ url('/repository/'.$proyek['repoCode'].'/edit') }}" class="btn btn-outline-primary btn-sm w-100 mt-3 rounded-pill">Edit Details</a>
                @endif
            </div>
        </div>

        <div class="gallery-showcase card-base">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold mb-0">Galeri Project</h4>
                    <p class="text-muted mb-0 small">Jelajahi Keindahan Dari Project </p>
                </div>
                @if(count($proyek['images']) > 1)
                <div class="d-flex gap-2">
                    <button onclick="moveSlider('gallery', -1)" class="btn-nav shadow-none border"><i class="bi bi-chevron-left"></i></button>
                    <button onclick="moveSlider('gallery', 1)" class="btn-nav shadow-none border"><i class="bi bi-chevron-right"></i></button>
                </div>
                @endif
            </div>
            <div class="gallery-container">
                @if(count($proyek['images']) > 0)
                    <div class="track-container gallery-track">
                        @foreach($proyek['images'] as $img)
                            <div class="item-media">
                                <a href="{{ asset('images/proyek/'.$img['lokasi']) }}" target="_blank" class="w-100 h-100 d-flex justify-content-center">
                                    <img src="{{ asset('images/proyek/'.$img['lokasi']) }}" alt="UI Presentation">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-placeholder">
                        <i class="bi bi-image"></i>
                        <p class="small mb-0">Screenshot interface belum diunggah</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="team-section">
            <div class="card-base h-100">
                <h5 class="fw-bold mb-3">Kolaborator</h5>
                <div class="row g-2">
                    @forelse($mahasiswa as $index => $mhs)
                        <div class="col-md-6">
                            <button class="contrib-card border-0" onclick="showMahasiswa({{$index}})">
                                <img src="{{ asset('image/profile-default.png') }}" class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                                <div class="text-truncate">
                                    <div class="fw-bold small">{{ $mhs["nama"] }}</div>
                                    <div class="text-muted" style="font-size: 10px;">NIM: {{ $mhs['nim'] }}</div>
                                </div>
                            </button>
                        </div>
                    @empty
                        <p class="text-muted small ps-2">Data kolaborator tidak ditemukan.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="file-section">
            <div class="card-base h-100">
                <h5 class="fw-bold mb-4">Dokumen Proyek</h5>
                
                @if (!$proyek["file_laporan"] && !$proyek["file_ppt"])
                    <div class="text-center py-4">
                        <i class="bi bi-folder-x display-4 text-muted opacity-25"></i>
                        <p class="text-muted small mt-2">Belum ada dokumen yang diunggah.</p>
                    </div>
                @else
                    {{-- Laporan (PDF) --}}
                    @if ($proyek["file_laporan"])
                        <a href="{{ asset('document/Laporan/' . $proyek['file_laporan']) }}" class="file-btn" target="_blank">
                            <div class="file-icon-box pdf-bg">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </div>
                            <div class="file-info">
                                <span class="file-name">Laporan Akhir</span>
                                <span class="file-size">PDF Document</span>
                            </div>
                            <i class="bi bi-cloud-arrow-down download-cloud"></i>
                        </a>
                    @endif

                    {{-- PPT --}}
                    @if ($proyek["file_ppt"])
                        <a href="{{ asset('document/PPT/' . $proyek['file_ppt']) }}" class="file-btn" target="_blank">
                            <div class="file-icon-box ppt-bg">
                                <i class="bi bi-file-earmark-ppt-fill"></i>
                            </div>
                            <div class="file-info">
                                <span class="file-name">Presentasi Proyek</span>
                                <span class="file-size">PowerPoint Document</span>
                            </div>
                            <i class="bi bi-cloud-arrow-down download-cloud"></i>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    const mahasiswaContrib = @json($mahasiswa);
    let galleryIndex = 0;
    let videoIndex = 0;
    const totalImages = {{ count($proyek['images']) }};
    const totalVideos = {{ count($proyek['videos']) }};

    function moveSlider(type, direction) {
        if (type === 'gallery' && totalImages > 0) {
            galleryIndex = (galleryIndex + direction + totalImages) % totalImages;
            document.querySelector('.gallery-track').style.transform = `translateX(-${galleryIndex * 100}%)`;
        } else if (type === 'video' && totalVideos > 0) {
            videoIndex = (videoIndex + direction + totalVideos) % totalVideos;
            document.querySelector('.video-track').style.transform = `translateX(-${videoIndex * 100}%)`;
        }
    }

    // Modal logic tetap sama...
    function showMahasiswa(index) {
        const m = mahasiswaContrib[index];
        document.getElementById('m-nama').innerText = m.nama;
        document.getElementById('m-nim').innerText = m.nim;
        document.getElementById('m-email').innerText = m.user ? m.user.email : 'No email provided';
        document.getElementById('m-kelas-angkatan').innerText = `${m.kelas || '-'} / ${m.angkatan || '-'}`;
        document.getElementById('m-sosmed').innerHTML = m.sosial_media?.length ? m.sosial_media.map(s => `<a href="${s.link}" target="_blank" class="btn btn-xs btn-outline-dark rounded-pill" style="font-size:10px; padding:2px 8px;">${s.platform}</a>`).join('') : '<span class="text-muted small">No social media</span>';
        document.getElementById('m-proyek').innerHTML = m.proyek?.length ? m.proyek.map(p => `<a href="/repository/${p.repoCode}" class="file-btn py-2 mb-1 d-flex" style="font-size: 11px; background: #f8fafc;">${p.judul}</a>`).join('') : '<span class="text-muted small">No other projects</span>';
        document.getElementById('panelMahasiswa').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function hideMahasiswa() { document.getElementById('panelMahasiswa').style.display = 'none'; document.body.style.overflow = 'auto'; }
</script>