<section id="contact" class="py-5" style="background-color: #ffffff; position: relative; overflow: hidden; min-height: 100vh;">
    
    <div class="visual-blob blob-top-left"></div>
    <div class="visual-blob blob-top-right"></div>
    <div class="visual-blob blob-bottom-left"></div>
    <div class="visual-blob blob-center-right"></div>

    <div class="container py-5 position-relative" style="z-index: 10;">
        <div class="contact-main-wrapper shadow-extreme bg-white">
            <div class="row g-0">
                
                <div class="col-lg-5 p-4 p-md-5 border-end">
                    <div class="contact-header">
                        <span class="badge rounded-pill mb-3 px-3 py-2" style="background: #002f6c; color: white;">CONNECT WITH US</span>
                        <h2 class="fw-bold text-dark mb-3 display-6">Butuh Bantuan <br><span style="color: #0d6efd;">Riset Anda?</span></h2>
                        <p class="text-secondary small mb-5">
                            Hubungi unit pengelola repository kami untuk kendala akses atau publikasi karya ilmiah.
                        </p>
                    </div>

                    <div class="contact-info-list">
                        <div class="item-modern mb-4">
                            <div class="icon-circle-dark"><i class="bi bi-geo-alt-fill"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Lokasi</h6>
                                <small class="text-muted">Jl. Raya Lohbener Lama No.08, Indramayu</small>
                            </div>
                        </div>
                        <div class="item-modern mb-4">
                            <div class="icon-circle-dark"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Email</h6>
                                <small class="text-muted">info@polindra.ac.id</small>
                            </div>
                        </div>
                        <div class="item-modern">
                            <div class="icon-circle-dark"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Telepon</h6>
                                <small class="text-muted">(0234) 5746464</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 p-4 p-md-5" style="background-color: #f8faff;">
                    <div class="browser-window shadow-lg">
                        <div class="browser-top">
                            <div class="browser-dots">
                                <span style="background: #ff5f56;"></span>
                                <span style="background: #ffbd2e;"></span>
                                <span style="background: #27c93f;"></span>
                            </div>
                            <div class="browser-url">maps.google.com/polindra</div>
                        </div>
                        <div class="browser-content">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3779.033961559905!2d108.27887677476542!3d-6.408414693582323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb87d1fcaf97d%3A0x4fc15b3c8407ada4!2sPoliteknik%20Negeri%20Indramayu!5e1!3m2!1sid!2sid!4v1766290758332!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="browser-footer-social">
                            <span class="small fw-bold text-white me-auto">FOLLOW US</span>
                            <div class="social-links">
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    /* KONFIGURASI BLOB (PERSIS DESAIN) */
    .visual-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(50px);
        z-index: 1;
        pointer-events: none;
    }

    /* Blob Biru Tua Pekat di kiri bawah */
    .blob-bottom-left {
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, #002555 0%, #003d8d 100%);
        bottom: -150px;
        left: -100px;
        opacity: 0.8; /* Dibuat pekat seperti desain */
    }

    /* Blob Biru Sedang di kanan atas */
    .blob-top-right {
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, #0d6efd 0%, #003d8d 100%);
        top: -100px;
        right: -80px;
        opacity: 0.6;
    }

    /* Blob Biru Muda Halus di kiri atas */
    .blob-top-left {
        width: 300px;
        height: 300px;
        background: #0d6efd;
        top: 5%;
        left: -5%;
        opacity: 0.3;
    }

    /* Blob Tambahan di sisi kanan */
    .blob-center-right {
        width: 200px;
        height: 200px;
        background: #002f6c;
        top: 40%;
        right: -50px;
        opacity: 0.4;
    }

    /* CARD WRAPPER */
    .contact-main-wrapper {
        border-radius: 40px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
        z-index: 5;
    }
    .shadow-extreme {
        box-shadow: 0 40px 120px rgba(0, 37, 85, 0.15) !important;
    }

    /* INFO LIST */
    .icon-circle-dark {
        width: 45px; height: 45px;
        background: #002f6c; color: white;
        border-radius: 50%; display: flex;
        align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .item-modern { display: flex; align-items: center; gap: 15px; }

    /* BROWSER WINDOW MAP */
    .browser-window { border-radius: 25px; overflow: hidden; background: #fff; border: 1px solid #e0e0e0; }
    .browser-top { background: #ffffff; padding: 12px 20px; display: flex; align-items: center; border-bottom: 1px solid #eee; }
    .browser-dots span { height: 9px; width: 9px; border-radius: 50%; display: inline-block; margin-right: 5px; }
    .browser-url { background: #f1f3f4; border-radius: 8px; font-size: 10px; color: #888; padding: 4px 30px; margin-left: auto; margin-right: auto; }
    
    .browser-footer-social { background: #002f6c; padding: 15px 30px; display: flex; align-items: center; }
    .social-links a { color: white; margin-left: 20px; font-size: 1.1rem; opacity: 0.8; transition: 0.3s; }
    .social-links a:hover { color: #ffc107; opacity: 1; transform: scale(1.2); }

    @media (max-width: 991px) {
        .contact-main-wrapper { border-radius: 20px; }
        .border-end { border-bottom: 1px solid #eee !important; border-right: none !important; }
    }
</style>