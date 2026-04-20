<style>
    .page-wrap {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
    }
    .card-profile {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        padding: 25px;
    }
    .back-btn {
        display: inline-block;
        margin-bottom: 20px;
        text-decoration: none;
        background: #2563eb;
        color: #fff;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 14px;
    }
    .profile-header {
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .profile-header img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
    }
    .profile-name {
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }
    .info-list {
        margin-top: 15px;
        font-size: 16px;
        color: #374151;
        line-height: 1.7;
    }
    .section-title {
        margin-top: 28px;
        font-size: 20px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 12px;
    }
    .social-links a {
        display: inline-block;
        text-decoration: none;
        background: #e5e7eb;
        padding: 10px 14px;
        border-radius: 10px;
        margin-right: 8px;
        font-size: 14px;
        color: #1f2937;
    }
    .project-list a {
        display: block;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        padding: 14px;
        border-radius: 10px;
        margin-bottom: 10px;
        text-decoration: none;
        font-size: 15px;
        color: #1f2937;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
</style>
<div class="page-wrap">
    <div class="card-profile">
        <a href="{{ $prevPage }}" class="back-btn"><i class="bi bi-arrow-left-short"></i> Kembali</a>


        <div class="profile-header">
            <img src="{{ asset('image/profile-default.png') }}">
            <div>
                <div class="profile-name">Unkwown</div>
                <div class="info-list">
                NIM: -<br>
                Kelas: -<br>
                Tahun Angkatan: 0<br>
                Email : -
            </div>
            </div>
        </div>


        <div class="section-title">Kontak & Sosial Media</div>
        <div class="social-links">
            @if (count($mahasiswa['sosial_media']) > 0)
                <a href="#">Instagram</a>
            @endif
            
        </div>


        <div class="section-title">Project yang Pernah Dikontribusikan</div>
        <div class="project-list">
            <a href="#">E-Learning Platform</a>
            <a href="#">Smart Campus IoT System</a>
            <a href="#">AI-Powered Chatbot Assistant</a>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

// function loadProfilData(){
//     let link = `/api/v3/mahasiswa/${nim}`;
}

</script>