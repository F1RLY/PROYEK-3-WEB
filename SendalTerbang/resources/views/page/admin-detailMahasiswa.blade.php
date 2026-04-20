<?php
use App\Models\Hash;
?>

<style>
.detail-proyek {
    width: 90%;
    margin: 30px auto;
    font-family: 'Segoe UI', sans-serif;
    color: #333;
}

/* HEADER SECTION */
.detail-header-yanglainnya {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.detail-back-btn a {
    font-size: 20px;
    text-decoration: none;
    color: #333;
    transition: .2s;
}

.detail-back-btn a:hover {
    opacity: .5;
}

.detail-header-proyek {
    font-size: 26px;
    font-weight: 600;
    color: #2252c4;
    margin-bottom: 8px;
}

/* LIST WRAPPER */
.detail-list {
    list-style-type: none;
    padding: 0;
}

/* BOX WRAPPER */
.detail-panel-project,
.detail-group,
.detail-link {
    background: white;
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.08);
    padding: 18px 22px;
    margin-bottom: 20px;
    box-shadow: 0px 2px 6px rgba(0,0,0,0.04);
}

/* TITLE LABEL */
.detail-header {
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
    color: #666;
}

/* VALUE BOX */
.detail-value {
    list-style-type: none;
    margin-bottom: 10px;
    padding: 12px 14px;
    background: #ebeff7;
    border-radius: 6px;
    font-size: 15px;
    border: 1px solid rgba(0,0,0,0.04);
    color: #333;
}

/* VALUE LINKS */
.detail-value a {
    text-decoration: none;
    color: #2d4dd6;
    font-weight: 500;
}

.detail-value a:hover {
    text-decoration: underline;
}

/* GRID COLUMNS */
.detail-panel-project ul {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 15px;
}

/* GROUP LIST */
.detail-group ul {
    padding-left: 0;
}

.detail-group .detail-value {
    background: white;
    border: 1px solid rgba(0,0,0,0.1);
    transition: .20s;
}

.detail-group .detail-value:hover {
    background: #e5ecff;
    border-color: #b7c4f6;
}

/* CONTACT STYLE */
.detail-group a {
    text-decoration: none;
    color: #2455d6;
}

.detail-group a:hover {
    text-decoration: underline;
}


</style>

<div class="detail-proyek">

    <div class="detail-header-yanglainnya">
        <h1 class="detail-back-btn">
            <a href="/admin-kelola-akun"><i class="bi bi-arrow-left-circle"></i> back</a>
        </h1>

        <h1 class="detail-header-proyek" ><i class="bi bi-journal-text"></i> Detail Mahasiswa</h1>
    </div>

    <ul class="detail-list">

        <li class="detail-panel-project">

            <ul>
                <li class="detail-header">Nama :
                    <ul>
                        <li class="detail-value">{{ $mahasiswa["nama"] }}</li>
                    </ul>
                </li>
    
                <li class="detail-header">Nomor Induk Mahasiswa : 
                    <ul>
                        <li class="detail-value" >{{ $mahasiswa["nim"] }}</li>
                    </ul>
                </li>
                
            </ul>

        </li>

        <li class="detail-panel-project">

            <ul>
                <li class="detail-header">Angkatan :
                    <ul>
                        <li class="detail-value">{{ $mahasiswa["angkatan"] }}</li>
                    </ul>
                </li>
    
                <li class="detail-header">Kelas : 
                    <ul>
                        <li class="detail-value" >B</li>
                    </ul>
                </li>
                
            </ul>

        </li>

        <li class="detail-link">Web : 
            <ul>
                <li class="detail-value"><a href="http://proyek2a6.proyek.jti.polindra.ac.id/">http://proyek2a6.proyek.jti.polindra.ac.id/</a></li>
            </ul>
        </li>

        <li class="detail-header detail-group">Berkontribusi di Proyek :

            <ul>
                <li class="detail-header detail-mahasiswa">
                    <ul>
                        @foreach ($mahasiswa["proyek"] as $proyek )
                            <li class="detail-value"><a href="/admin-detail-proyek/{{ $proyek['repoCode'] }}">{{ $proyek["judul"] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                
            </ul>

        </li>

        <li class="detail-header detail-group">Contact :

            <ul>
                <li class="detail-header detail-mahasiswa">Mahasiswa :
                    <ul>
                        @foreach ( $mahasiswa["sosial-media"] as $sosialMedia )
                            <a href="{{ $sosialMedia["link"] }}"><li class="detail-value">{{ $sosialMedia["nama"] }}</li></a>
                        @endforeach
                    </ul>
                </li>
                
                <li class="detail-header detail-dosen">Email : 
                    <ul>
                        <li class="detail-value"><a href="mailto:{{ $mahasiswa["email"] }}">{{ $mahasiswa["email"] }}</a></li>
                    </ul>
                </li>
                
            </ul>

        </li>

    </ul>

</div>