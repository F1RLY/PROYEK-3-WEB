<div class="container my-5">

    {{-- 1. AREA NOTIFIKASI (Muncul di paling atas setelah redirect) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0" role="alert" style="border-left: 5px solid #198754 !important;">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                <div>
                    <strong class="d-block">Berhasil!</strong>
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm border-0" role="alert" style="border-left: 5px solid #dc3545 !important;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                <div>
                    <strong class="d-block">Terjadi Kesalahan!</strong>
                    @if(session('error'))
                        {{ session('error') }}
                    @endif
                    @if($errors->any())
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        
        {{-- KOLOM KIRI: EDIT FOTO & MEDSOS --}}
        <div class="col-lg-8">
            <div class="card p-4 shadow-sm profile-card-soft border-0">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <a href="{{ url('/profile') }}" class="text-decoration-none fw-medium text-muted">
                            <i class="bi bi-arrow-left-short"></i> Kembali ke Profil
                        </a>
                        <h4 class="mb-0 fw-bold text-primary">Pengaturan Profil</h4>
                    </div>
                    
                    <form action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        
                        <h5 class="mb-3 text-dark fw-bold"><i class="bi bi-person-circle me-2 text-primary"></i> Identitas & Foto</h5>
                        
                        <div class="row align-items-center mb-4">
                            <div class="col-md-3 text-center mb-3 mb-md-0">
                                <img id="previewImage" class="profile-avatar rounded-circle border border-primary border-3 p-1 mb-2"
                                    src="{{ Auth::user()->foto ? asset('image/'.Auth::user()->foto) : asset('image/profile-default.png') }}"
                                    alt="Avatar"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                                
                                <label for="avatarFile" class="btn btn-sm btn-outline-primary mt-1 px-3">Ganti Foto</label>
                                <input type="file" id="avatarFile" name="avatar" class="d-none" accept="image/*">
                            </div>
                            
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Username</label>
                                    <input type="text" class="form-control bg-light text-muted fw-medium" value="{{ Auth::user()->username }}" readonly>
                                    <small class="text-muted fst-italic">*Username dikunci oleh sistem.</small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">

                        <h5 class="mb-3 text-dark fw-bold"><i class="bi bi-share-fill me-2 text-primary"></i> Tautan Sosial Media</h5>
                        <p class="small text-muted mb-3">Masukkan link lengkap (URL) agar orang lain bisa mengunjungi profil Anda.</p>
                        
                        <div class="row g-3">
                            {{-- Mapping ID Sosmed (Sesuaikan dengan ID di tabel sosial_media Anda) --}}
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Instagram</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-instagram text-danger"></i></span>
                                    <input type="url" name="socials[1]" class="form-control" placeholder="https://instagram.com/username" value="{{ $currentSocials[1] ?? '' }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Facebook</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-facebook text-primary"></i></span>
                                    <input type="url" name="socials[2]" class="form-control" placeholder="https://facebook.com/username" value="{{ $currentSocials[2] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">LinkedIn</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-linkedin text-info"></i></span>
                                    <input type="url" name="socials[3]" class="form-control" placeholder="https://linkedin.com/in/username" value="{{ $currentSocials[3] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">TikTok</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-tiktok text-dark"></i></span>
                                    <input type="url" name="socials[4]" class="form-control" placeholder="https://tiktok.com/@username" value="{{ $currentSocials[4] ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm rounded-pill">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: UPDATE PASSWORD --}}
        <div class="col-lg-4">
            <div class="card p-4 shadow-sm profile-card-soft border-0">
                <h5 class="card-title mb-3 fw-bold text-danger"><i class="bi bi-shield-lock me-2"></i> Keamanan Akun</h5>
                <p class="small text-muted mb-4">Gunakan password yang kuat untuk keamanan akun Anda.</p>
                <hr class="mt-0 mb-3 opacity-50"> 

                <form action="{{ url('/profile/update-password') }}" method="POST">
                    @csrf 
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Min. 6 Karakter" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control" placeholder="Ulangi Password Baru" required>
                    </div>
                    
                    <button type="submit" class="btn btn-danger w-100 fw-bold rounded-pill mt-2">Update Password</button>
                </form>
            </div>
        </div>

    </div>
</div>

{{-- SCRIPT UNTUK PREVIEW FOTO LANGSUNG --}}
<script>
    document.getElementById('avatarFile').onchange = function (evt) {
        const [file] = this.files
        if (file) {
            // Mengganti src pada img dengan ID previewImage
            document.getElementById('previewImage').src = URL.createObjectURL(file)
        }
    }
</script>