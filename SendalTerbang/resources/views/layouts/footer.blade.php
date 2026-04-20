<footer class="footer-main text-white pt-5 pb-4">
  <div class="footer-border-top"></div>

  <div class="footer-pattern-left"></div>
  
  <div class="container position-relative" style="z-index: 10;">
    <div class="row">

      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
        <div class="d-flex align-items-center mb-3">
          <div class="logo-footer-wrapper">
            <img src="{{ asset('image/logo.png') }}" alt="Logo Polindra" width="50" height="50">
          </div>
          <div class="ms-3">
            <h6 class="fw-bold mb-0 text-uppercase brand-text-footer">Politeknik Negeri Indramayu</h6>
          </div>
        </div>
        <div class="footer-info-text opacity-75">
          <p class="small mb-2"><i class="bi bi-geo-alt-fill me-2 text-warning"></i> Jl. Raya Lohbener Lama No.08, Indramayu</p>
          <p class="small mb-2"><i class="bi bi-telephone-fill me-2 text-warning"></i> (0234) 5746464</p>
          <p class="small"><i class="bi bi-envelope-fill me-2 text-warning"></i> info@polindra.ac.id</p>
        </div>
      </div>

      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase fw-bold mb-4 footer-heading">Navigasi</h6>
        <div class="footer-links">
          <p><a href="{{ url('/') }}">Beranda</a></p>
          <p><a href="{{ url('/about') }}">Tentang Kami</a></p>
          <p><a href="{{ url('/repository') }}">Repository</a></p>
          <p><a href="{{ url('/contact') }}">Kontak</a></p>
        </div>
      </div>

      <div class="col-md-5 col-lg-4 col-xl-4 mx-auto mt-3">
        <h6 class="text-uppercase fw-bold mb-4 footer-heading">Lokasi Kampus</h6>
        <div class="map-container shadow-lg">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.254146313833!2d108.28189877413038!3d-6.361141762228801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb94649b38063%3A0x7d97526d7aa1965c!2sPoliteknik%20Negeri%20Indramayu!5e0!3m2!1sid!2sid!4v1700000000000" width="100%" height="180" style="border:0;" loading="lazy"></iframe>
        </div>
      </div>

    </div>

    <hr class="mt-4 mb-3 border-white opacity-10">

    <div class="row align-items-center">
      <div class="col-md-12 text-center">
        <p class="mb-0 small opacity-50">
          © {{ date('Y') }} <strong>Politeknik Negeri Indramayu</strong> — All Rights Reserved.
        </p>
      </div>
    </div>
  </div>
</footer>

<style>
  .footer-main {
    background: radial-gradient(circle at 50% 50%, #003d8d 0%, #002555 100%);
    position: relative;
    padding-top: 60px !important; /* Memberi ruang agar garis pembatas tidak menempel teks */
  }

  /* PEMBATAS GARIS TIPIS & MEWAH */
  .footer-border-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    /* Gradasi garis: Transparan -> Putih Solid -> Transparan */
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.5), transparent);
    z-index: 5;
  }

  /* Efek Glow kecil tepat di bawah garis */
  .footer-border-top::after {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 10px;
    background: rgba(255, 255, 255, 0.05);
    filter: blur(8px);
    z-index: 4;
  }

  .footer-pattern-left {
    position: absolute;
    bottom: 0; left: 0; width: 40%; height: 100%;
    z-index: 1; opacity: 0.1; pointer-events: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 300' fill='%23ffffff'%3E%3Cpath d='M0 300V150h40v-20h20v20h40v150zM150 300V100h60v200zM300 300V180h50v120zM400 300V200h80v100z'/%3E%3C/svg%3E");
    background-position: bottom left; background-repeat: no-repeat; background-size: contain;
  }

  .logo-footer-wrapper { background: rgba(255, 255, 255, 0.1); padding: 8px; border-radius: 12px; backdrop-filter: blur(5px); }
  .brand-text-footer { font-size: 1rem; letter-spacing: 0.5px; line-height: 1.3; }
  .footer-heading { font-size: 0.9rem; letter-spacing: 1.5px; color: #ffc107; }

  .footer-links p { margin-bottom: 10px; }
  .footer-links a {
    color: rgba(255, 255, 255, 0.65) !important;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-decoration: none !important;
  }
  .footer-links a:hover { color: #ffffff !important; padding-left: 5px; }

  .map-container { border: 4px solid rgba(255, 255, 255, 0.05); border-radius: 15px; overflow: hidden; }
</style>