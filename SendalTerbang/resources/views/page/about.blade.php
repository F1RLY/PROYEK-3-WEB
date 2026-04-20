<section id="about" class="py-5" style="background-color: #ffffff; position: relative; overflow: hidden; min-height: 90vh; display: flex; align-items: center;">
    
    <div class="visual-blob blob-about-1"></div>
    <div class="visual-blob blob-about-2"></div>
    <div class="visual-blob blob-about-3"></div>

    <div class="container py-5 position-relative" style="z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="about-main-card shadow-extreme">
                    <div class="row g-0">
                        
                        <div class="col-lg-5 d-flex align-items-center justify-content-center p-5 bg-soft-blue border-end">
                            <div class="text-center">
                                <div class="floating-logo-wrapper mb-4">
                                    <img src="{{ asset('image/logo.png') }}" alt="Logo Polindra" class="img-fluid p-4" style="max-width: 200px;">
                                </div>
                                <div class="badge-status-modern">
                                    <span class="pulse-dot"></span> Official Academic Repository
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 p-5 bg-white">
                            <div class="ps-lg-3">
                                <h6 class="text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 3px; font-size: 0.8rem;">Tentang Kami</h6>
                                <h2 class="display-6 fw-bold text-dark mb-4">Melindungi Karya, Menjaga Masa Depan <span class="text-primary">Inovasi.</span></h2>
                                
                                <p class="text-secondary fs-6 mb-4 lh-lg">
                                    Repository Polindra adalah rumah digital bagi seluruh karya ilmiah civitas akademika Politeknik Negeri Indramayu. Kami hadir untuk memfasilitasi akses pengetahuan yang transparan, aman, dan terintegrasi bagi seluruh civitas akademika.
                                </p>

                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="bento-info-card">
                                            <div class="icon-box-about"><i class="bi bi-box-seam"></i></div>
                                            <div>
                                                <h6 class="fw-bold mb-1 text-dark">Penyimpanan Terpusat</h6>
                                                <small class="text-muted small-text">Arsip tertata rapi sesuai kategori.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="bento-info-card">
                                            <div class="icon-box-about"><i class="bi bi-eye"></i></div>
                                            <div>
                                                <h6 class="fw-bold mb-1 text-dark">Akses Terbuka</h6>
                                                <small class="text-muted small-text">Mudah diakses di mana saja.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 d-flex gap-3 align-items-center flex-wrap">
                                    <a href="/" class="btn btn-polindra-primary rounded-pill px-5 py-2 fw-bold shadow-sm">Jelajahi Riset</a>
                                    <div class="divider-vertical d-none d-sm-block"></div>
                                    <span class="text-muted small">Mendukung Akreditasi & <br>Publikasi Kampus</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>

<style>
    /* KONFIGURASI BLOB (About Theme) */
    .visual-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        z-index: 1;
        pointer-events: none;
    }

    /* Blob Besar di Kanan Bawah */
    .blob-about-1 {
        width: 500px; height: 500px;
        background: radial-gradient(circle, #002f6c 0%, #0d6efd 100%);
        bottom: -150px; right: -100px;
        opacity: 0.12; /* Dibuat sedikit lebih soft dari kontak agar tidak mengganggu bacaan */
    }

    /* Blob Biru Terang di Kiri Atas */
    .blob-about-2 {
        width: 400px; height: 400px;
        background: #0d6efd;
        top: -100px; left: -50px;
        opacity: 0.08;
    }

    /* Blob Kuning Halus di Samping Teks */
    .blob-about-3 {
        width: 250px; height: 250px;
        background: #ffc107;
        top: 20%; right: 10%;
        opacity: 0.04;
    }

    /* MAIN CARD CUSTOM */
    .about-main-card {
        border-radius: 40px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .shadow-extreme {
        box-shadow: 0 40px 100px rgba(0, 47, 108, 0.1) !important;
    }

    /* VISUAL LEFT SIDE */
    .bg-soft-blue { background-color: #f8faff; }
    .floating-logo-wrapper {
        background: white;
        border-radius: 35px;
        box-shadow: 0 20px 45px rgba(0,47,108,0.08);
        animation: floatAnim 4s ease-in-out infinite;
    }

    /* BADGE & ICONS */
    .badge-status-modern {
        display: inline-flex;
        align-items: center;
        background: #ffffff;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #002f6c;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .pulse-dot {
        height: 8px; width: 8px;
        background-color: #0d6efd;
        border-radius: 50%; margin-right: 10px;
        animation: pulse 1.5s infinite;
    }

    /* BENTO CARD */
    .bento-info-card {
        background: #fcfdfe;
        padding: 22px;
        border-radius: 25px;
        height: 100%;
        display: flex;
        gap: 15px;
        border: 1px solid #f0f3f5;
        transition: 0.3s;
    }
    .bento-info-card:hover { transform: translateY(-5px); background: white; border-color: #0d6efd; }
    .icon-box-about { font-size: 1.6rem; color: #0d6efd; }
    .small-text { font-size: 0.75rem; line-height: 1.2; }

    /* BUTTONS & MISC */
    .btn-polindra-primary { background: #002f6c; color: white; border: none; transition: 0.3s; }
    .btn-polindra-primary:hover { background: #0d6efd; color: white; transform: scale(1.05); }
    .divider-vertical { width: 1px; height: 40px; background: #dee2e6; }

    /* ANIMATIONS */
    @keyframes floatAnim {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.5); opacity: 0.5; }
        100% { transform: scale(1); opacity: 1; }
    }

    @media (max-width: 991px) {
        .about-main-card { border-radius: 25px; }
        .border-end { border: none !important; border-bottom: 1px solid #f0f3f5 !important; }
    }
</style>