<style>
.detail-proyek {
    width: 94%;
    margin: 18px auto 50px auto;
    font-family: 'Segoe UI', sans-serif;
    color: #333;
}

/* TOP HEADER */
.detail-header-yanglainnya {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 25px;
}

.detail-back-btn a {
    text-decoration: none;
    color: #333;
    font-size: 20px;
    transition: .2s;
}

.detail-back-btn a:hover {
    opacity: .5;
}

.detail-header-proyek {
    font-size: 24px;
    font-weight: 600;
    margin-top: -1px;
    color: #2460d1;
}

/* MAIN LIST */
.detail-list {
    list-style-type: none;
    padding: 0;
}

/* CARD PANEL */
.detail-panel-project {
    background: #ffffff;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 6px;
    padding: 18px 22px;
    margin-bottom: 15px;
    box-shadow: 0px 2px 6px rgba(0,0,0,0.04);
}

/* HEADER LABEL */
.detail-header {
    font-weight: 600;
    margin-bottom: 6px;
    font-size: 15px;
    color: #505050;
}

/* VALUE BOX */
.detail-value {
    background: #f4f6fa;
    padding: 9px 12px;
    border-radius: 5px;
    margin-top: 4px;
    margin-bottom: 8px;
    font-size: 15px;
    list-style-type: none;
    border: 1px solid rgba(0,0,0,0.05);
}

/* LINK */
.detail-link a,
.detail-value a {
    text-decoration: none;
    color: #2460d1;
    transition: .2s;
}

.detail-link a:hover,
.detail-value a:hover {
    opacity: .6;
}

/* PROJECT CONTRIBUTION AREA */
.detail-group {
    background: #ffffff;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 6px;
    padding: 20px 22px;
    margin-top: 22px;
    margin-bottom: 15px;
    box-shadow: 0px 2px 6px rgba(0,0,0,0.04);
}

/* CONTRIBUTION ITEMS */
.detail-mahasiswa .detail-value {
    background: #ffffff;
    border: 1px solid rgba(0,0,0,0.1);
    font-size: 14px;
    padding: 10px 12px;
    transition: .2s;
}

.detail-mahasiswa .detail-value:hover {
    background: #eaf0ff;
    border-color: #b6c9ff;
}

/* GRID LOOK */
.detail-panel-project ul {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 12px;
}

/* CONTACT SECTION */
.detail-group a {
    text-decoration: none;
    color: #2460d1;
}

.detail-group a:hover {
    opacity: .6;
}

</style>

<div class="detail-proyek">

    <div class="detail-header-yanglainnya">
        <h1 class="detail-back-btn">
            <a href="/admin-kelola-proyek"><i class="bi bi-arrow-left-circle"></i> back</a>
        </h1>

        <h1 class="detail-header-proyek" ><i class="bi bi-journal-text"></i> Detail Proyek</h1>
    </div>

    <ul class="detail-list">

        <li class="detail-panel-project">

            <ul>
                <li class="detail-header">Judul :
                    <ul>
                        <li class="detail-value">{{ $proyek["judul"] }}</li>
                    </ul>
                </li>
    
                <li class="detail-header">Rating : 
                    <ul>
                        <li class="detail-value" >-/10</li>
                    </ul>
                </li>
                
            </ul>

        </li>

        <li class="detail-header">Deskripsi : 
            <ul>
                <li class="detail-value detail-desc">{{ $proyek["deskripsi"] }}
                </li>
            </ul>
        </li>

        <li class="detail-panel-project">
            <ul>
                <li class="detail-header">Proposal Proyek :
                    <ul>
                        @if( isset($proyek["file_proposal"]))
                            <a class="detail-value detail-file" href="document/Proposal/{{ $proyek["file_proposal"]}}"><li>Proposal</li></a>
                        @else
                            <a class="detail-value detail-file" href=""><li>Proposal (belum dikumpulkan)</li></a>
                        @endif
                    </ul>
                </li>
                <li class="detail-header">Laporan Proyek :
                    <ul>
                        @if( isset($proyek["file_ppt"]))
                            <a class="detail-value detail-file" href="document/PPT/{{ $proyek["file_ppt"] }}"><li>Laporan</li></a>
                        @else
                            <a class="detail-value detail-file" href=""><li>PPT (belum dikumpulkan)</li></a>
                        @endif
                    </ul>
                </li>
            </ul>
        </li>

        <li class="detail-link">Link : 
            <ul>
                <li class="detail-value"><a href="{{ $proyek['link'] }}">{{ $proyek['link'] }}</a></li>
            </ul>
        </li>

        <li class="detail-header detail-image">Gambar : 
            <ul>    
            </ul>
        </li>

        <li class="detail-header detail-group">Kontributor :

            <ul>
                <li class="detail-header detail-mahasiswa">Mahasiswa :
                    <ul>
                        @foreach ( $mahasiswaArr as $mahasiswa )
                            <li class="detail-value"><a href="/admin-kelola-akun/{{ $mahasiswa["kode"] }}">{{ $mahasiswa["username"] }} ({{ $mahasiswa["kode"] }})</a></li>
                        @endforeach
                    </ul>
                </li>
                
                <li class="detail-header detail-dosen">Dosen Pembimbing : 
                    <ul>
                        <li class="detail-value"><a href="/admin-kelola-akun">{{ isset($dosen) ? $dosen : '-' }}</a></li>
                    </ul>
                </li>
                
            </ul>

        </li>

    </ul>

</div>