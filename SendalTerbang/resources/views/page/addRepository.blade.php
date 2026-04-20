<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Proyek Baru</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;
            --primary-hover: #4338ca;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #f59e0b;
            --bg-body: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .sticky-header { 
            position: sticky; 
            top: 1.5rem; 
            z-index: 1000; 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px); 
            padding: 1.25rem 2rem; 
            border-radius: 1rem; 
            border: 1px solid rgba(226, 232, 240, 0.8); 
            margin-bottom: 2.5rem; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .sticky-header:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .form-section-card { 
            background: #ffffff; 
            border-radius: 1.25rem; 
            border: 1px solid var(--border-light); 
            padding: 2rem; 
            margin-bottom: 1.5rem; 
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-section-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .input-label { 
            font-weight: 700; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            color: var(--text-muted); 
            margin-bottom: 0.6rem; 
            display: block; 
            letter-spacing: 0.05em; 
        }
        
        .custom-input { 
            width: 100%; 
            padding: 0.875rem 1.25rem; 
            border-radius: 0.875rem; 
            border: 1.5px solid #f1f5f9; 
            background: #f8fafc; 
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .custom-input:focus { 
            outline: none; 
            border-color: var(--primary); 
            background: #fff; 
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
        }

        .custom-textarea {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border-radius: 0.875rem;
            border: 1.5px solid #f1f5f9;
            background: #f8fafc;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            resize: vertical;
            min-height: 120px;
        }

        .custom-textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-card {
            background: white;
            border-radius: 1.5rem;
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            max-height: 85vh;
            overflow: hidden;
            animation: slideUp 0.4s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        @keyframes slideUp {
            from { 
                transform: translateY(30px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* List Items */
        .list-item-modern { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 1rem 1.25rem; 
            background: #f8fafc; 
            border-radius: 1rem; 
            border: 1px solid var(--border-light); 
            margin-bottom: 0.75rem; 
            transition: all 0.2s ease;
        }

        .list-item-modern:hover {
            border-color: var(--primary);
            background: var(--primary-light);
            transform: translateX(4px);
        }

        /* Button Styles */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            border-radius: 0.875rem;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
            border-radius: 0.875rem;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
            color: white;
            border: none;
            border-radius: 0.875rem;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);
        }

        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);
            color: white;
        }

        .btn-light-custom {
            background: white;
            color: var(--text-dark);
            border: 1.5px solid var(--border-light);
            border-radius: 0.875rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-light-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* Search Input in Modal */
        .search-input-modal {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border-radius: 0.875rem;
            border: 1.5px solid #f1f5f9;
            background: #f8fafc;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-input-modal:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* Student/Dosen Items in Modal */
        .modal-list-item {
            width: 100%;
            text-align: left;
            background: #f8fafc;
            border: 1px solid var(--border-light);
            border-radius: 0.875rem;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            color: var(--text-dark);
            border: none;
        }

        .modal-list-item:hover {
            background: var(--primary-light);
            border-color: var(--primary);
            transform: translateX(4px);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.1);
        }

        .modal-list-item strong {
            display: block;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .modal-list-item small {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* Scrollable Lists */
        .scrollable-list {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .scrollable-list::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-list::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .scrollable-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .scrollable-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .section-title {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--primary);
        }

        /* Warning State */
        .warning-state {
            border: 2px solid var(--warning);
            background: #fffbeb;
        }

        .warning-state .dosen-name-selected {
            color: var(--warning);
        }

        /* Error Alert */
        .error-alert {
            display: none;
            background: #fee2e2;
            border: 1px solid var(--danger);
            color: var(--danger);
            padding: 0.875rem 1.25rem;
            border-radius: 0.875rem;
            margin-top: 1rem;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sticky-header {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .form-section-card {
                padding: 1.5rem;
            }
            
            .modal-card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .btn-primary-custom,
            .btn-outline-custom,
            .btn-danger-custom,
            .btn-light-custom {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Modal Tambah Mahasiswa -->
    <div class="modal-overlay add-mahasiswa-container">
        <div class="modal-card">
            <h5 class="fw-bold mb-4" style="color: var(--text-dark);">Tambah Anggota Tim</h5>
            <input type="text" onkeyup="find_mahasiswa(this.value)" class="search-input-modal" placeholder="Cari nama atau NIM...">
            <div class="scrollable-list student-list">
                @foreach($mahasiswa as $mhs)
                    <button type="button" onclick="add_mahasiswa_on_list(this.name, this.value)" name="{{ $mhs['nama'] }}" value="{{ $mhs['nim'] }}" class="modal-list-item">
                        <strong>{{ $mhs['nama'] }}</strong>
                        <small>{{ $mhs['nim'] }}</small>
                    </button>
                @endforeach
            </div>
            <button type="button" class="btn btn-light-custom w-100" onclick="hide_add_mahasiswa_container()">Batalkan</button>
        </div>
    </div>

    <!-- Modal Pilih Dosen -->
    <div class="modal-overlay set-dosen-container">
        <div class="modal-card">
            <h5 class="fw-bold mb-4" style="color: var(--text-dark);">Pilih Dosen Pembimbing</h5>
            <input type="text" onkeyup="find_dosen(this.value)" class="search-input-modal" placeholder="Cari nama dosen...">
            <div class="scrollable-list dosen-list">
                @for ( $i=0; $i<count($dosen); $i++ )
                    <button onclick="set_dosen( {{ $i }} )" value="{{ $dosen[$i]['kode'] }}" class="modal-list-item">
                        <strong>{{ $dosen[$i]['nama'] }}</strong>
                        <small>{{ $dosen[$i]['kode'] }}</small>
                    </button>
                @endfor
            </div>
            <button type="button" class="btn btn-light-custom w-100" onclick="hide_dosen_list()">Tutup</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        <form action="/profile/{{ session('account')['nim'] }}/add-proyek" method="post" id="main-form">
            @csrf
            
            <!-- Hidden Inputs (Untuk data yang akan dikirim) -->
            <div id="hidden-inputs-area" style="display: none;">
                <div class="dosen-selected-input"></div>
                <div class="team-list">
                    <input type='hidden' name="mahasiswa-nama-list[]" value='{{ session('account')['nama'] }}'>
                    <input type='hidden' name="mahasiswa-nim-list[]" value='{{ session('account')['nim'] }}'>
                </div>
            </div>
            
            <!-- Error Alert -->
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <!-- Sticky Header -->
            <div class="sticky-header">
                <a href="/repository" class="btn btn-light-custom">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Repository
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-plus-circle me-2"></i> Buat Proyek Baru
                </button>
            </div>

            <!-- Main Content Grid -->
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- Detail Proyek Card -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="bi bi-journal-text"></i> Detail Proyek
                            </h3>
                        </div>
                        
                        <div class="mb-4">
                            <label class="input-label">Judul Repository *</label>
                            <input type="text" name="judul" class="custom-input" placeholder="Masukkan judul repository yang menarik..." required>
                            <small class="text-muted mt-1 d-block">Contoh: Sistem Monitoring IoT untuk Smart Campus</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="input-label">Deskripsi Proyek *</label>
                            <textarea name="deskripsi" class="custom-textarea" rows="5" placeholder="Jelaskan secara detail tentang proyek yang akan dibuat..." required></textarea>
                            <small class="text-muted mt-1 d-block">Ceritakan tujuan, fitur, dan teknologi yang digunakan</small>
                        </div>
                        
                        <div class="mb-2">
                            <label class="input-label">Link Demo / Repository</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white" style="border: 1.5px solid #f1f5f9; border-right: none; border-radius: 0.875rem 0 0 0.875rem;">
                                    <i class="bi bi-link-45deg"></i>
                                </span>
                                <input type="text" name="link" class="custom-input" style="border-left: none; border-radius: 0 0.875rem 0.875rem 0;" placeholder="https://github.com/username/project">
                            </div>
                            <small class="text-muted mt-1 d-block">Opsional: Link ke GitHub, demo website, atau dokumentasi</small>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Dosen Pembimbing Card -->
                    <div class="form-section-card" id="dosen-section">
                        <div class="section-header">
                            <h6 class="section-title">
                                <i class="bi bi-person-badge"></i> Dosen Pembimbing *
                            </h6>
                        </div>
                        
                        <div id="dosen-pembimbing">
                            <div class="list-item-modern warning-state" id="dosen-selected-item">
                                <div>
                                    <div class="dosen-name-selected fw-bold text-warning">Belum dipilih</div>
                                    <small class="text-muted">Harus memilih dosen pembimbing</small>
                                </div>
                                <button type="button" onclick="show_dosen_list()" class="btn btn-outline-custom btn-sm">
                                    Pilih
                                </button>
                            </div>
                        </div>
                        
                        <div class="mt-3 text-center">
                            <small class="text-muted">Dosen pembimbing akan memberikan bimbingan selama pengerjaan proyek</small>
                        </div>
                        
                        <!-- Error message untuk dosen -->
                        <div id="dosen-error" class="error-alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <span id="dosen-error-text"></span>
                        </div>
                    </div>

                    <!-- Anggota Tim Card -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <h6 class="section-title">
                                <i class="bi bi-people"></i> Anggota Tim
                            </h6>
                        </div>
                        
                        <div id="anggota-list">
                            <!-- Diri sendiri otomatis ditambahkan -->
                            <div class="list-item-modern">
                                <div>
                                    <strong>{{ session('account')['nama'] }}</strong>
                                    <small class="text-muted d-block">{{ session('account')['nim'] }}</small>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" onclick="show_add_mahasiswa_container()" class="btn btn-outline-custom w-100 mt-3">
                            <i class="bi bi-plus-lg me-2"></i> Tambah Anggota
                        </button>
                        
                        <div class="mt-3 text-center">
                            <small class="text-muted">Maksimal 5 anggota termasuk ketua tim</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Toast (Hidden) -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="loadingToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-arrow-repeat me-2"></i> Menyimpan proyek...
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        // Inisialisasi data dari Laravel
        const self_nama = "{{ session('account')['nama'] }}";
        const self_nim = "{{ session('account')['nim'] }}";
        let dosen_list = @json($dosen);
        const mahasiswa_list_default = @json($mahasiswa);
        let mahasiswa_list = @json($mahasiswa);
        let mahasiswa_team_list = [
            {"nama": self_nama, "nim": self_nim},
        ];

        // Variabel untuk dosen yang dipilih
        let selected_dosen = null;

        // Fungsi untuk modal mahasiswa
        function show_add_mahasiswa_container() {
            $(".add-mahasiswa-container").css('display', 'flex');
            $("body").css("overflow", "hidden");
        }

        function hide_add_mahasiswa_container() {
            $(".add-mahasiswa-container").hide();
            $("body").css("overflow", "auto");
        }

        function find_mahasiswa(keyword) {
            const studentList = document.querySelector('.student-list');
            const buttons = studentList.querySelectorAll('button');
            
            keyword = keyword.toLowerCase();
            
            buttons.forEach(button => {
                const name = button.name.toLowerCase();
                const nim = button.value.toLowerCase();
                const text = button.textContent.toLowerCase();
                
                if (name.includes(keyword) || nim.includes(keyword) || text.includes(keyword)) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
        }

        function add_mahasiswa_on_list(nama, nim) {
            // Cek apakah mahasiswa sudah ada di list
            const isExist = mahasiswa_team_list.some(mhs => mhs.nim === nim);
            
            // Cek batas maksimal anggota (5 termasuk ketua)
            if (mahasiswa_team_list.length >= 5) {
                alert('Maksimal anggota tim adalah 5 orang (termasuk ketua).');
                return;
            }
            
            if (!isExist) {
                mahasiswa_team_list.push({"nama": nama, "nim": nim});
                update_anggota_list();
            } else {
                alert('Mahasiswa sudah ada dalam tim.');
            }
            
            hide_add_mahasiswa_container();
        }

        function remove_mahasiswa_from_list(nim) {
            // Tidak boleh menghapus diri sendiri (ketua)
            if (nim === self_nim) {
                alert('Anda adalah ketua tim, tidak dapat menghapus diri sendiri.');
                return;
            }
            
            mahasiswa_team_list = mahasiswa_team_list.filter(mhs => mhs.nim !== nim);
            update_anggota_list();
        }

        function update_anggota_list() {
            const anggotaList = $("#anggota-list");
            anggotaList.empty();
            
            // Update hidden inputs
            const teamListContainer = $(".team-list");
            teamListContainer.empty();
            
            mahasiswa_team_list.forEach((mhs, index) => {
                // Tambahkan ke tampilan
                const isSelf = mhs.nim === self_nim;
                anggotaList.append(`
                    <div class="list-item-modern ${isSelf ? 'border-primary' : ''}">
                        <div>
                            <strong>${mhs.nama}</strong>
                            <small class="text-muted d-block">${mhs.nim}</small>
                        </div>
                        ${isSelf ? 
                            '<span class="badge bg-primary">Ketua</span>' : 
                            `<button type="button" onclick="remove_mahasiswa_from_list('${mhs.nim}')" class="btn btn-sm btn-danger-custom">Hapus</button>`
                        }
                    </div>
                `);
                
                // Tambahkan ke hidden inputs (format sesuai dengan kode awal)
                teamListContainer.append(`
                    <input type='hidden' name="mahasiswa-nim-list[]" value='${mhs.nim}'>
                    <input type='hidden' name="mahasiswa-nama-list[]" value='${mhs.nama}'>
                `);
            });
        }

        // Fungsi untuk modal dosen
        function show_dosen_list() {
            $(".set-dosen-container").css('display', 'flex');
            $("body").css("overflow", "hidden");
        }

        function hide_dosen_list() {
            $(".set-dosen-container").hide();
            $("body").css("overflow", "auto");
        }

        function find_dosen(keyword) {
            const dosenList = document.querySelector('.dosen-list');
            const buttons = dosenList.querySelectorAll('button');
            
            keyword = keyword.toLowerCase();
            
            buttons.forEach(button => {
                const name = button.querySelector('strong').textContent.toLowerCase();
                const kode = button.querySelector('small').textContent.toLowerCase();
                
                if (name.includes(keyword) || kode.includes(keyword)) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
        }

        function set_dosen(index) {
            const dosen = dosen_list[index];
            selected_dosen = dosen;
            
            // Update tampilan UI
            const dosenItem = document.getElementById('dosen-selected-item');
            dosenItem.classList.remove('warning-state');
            dosenItem.querySelector('.dosen-name-selected').className = 'dosen-name-selected fw-bold text-primary';
            dosenItem.querySelector('.dosen-name-selected').innerHTML = `<strong>${dosen.nama}</strong>`;
            dosenItem.querySelector('small').textContent = `Kode: ${dosen.kode}`;
            
            // Update hidden inputs - format harus sama dengan kode awal
            $(".dosen-selected-input").html(`
                <input type="hidden" name="dosen_selected[]" value="${dosen.kode}">
                <input type="hidden" name="dosen_selected[]" value="${dosen.nama}">
            `);
            
            // Sembunyikan error jika ada
            $('#dosen-error').hide();
            
            hide_dosen_list();
        }

        // Inisialisasi awal
        $(document).ready(function() {
            // Update anggota list saat pertama kali load
            update_anggota_list();
            
            // Form submission handling
            $('#main-form').on('submit', function(e) {
                // Validasi
                let isValid = true;
                
                // Validasi judul
                const judul = $('input[name="judul"]').val().trim();
                if (!judul) {
                    isValid = false;
                    $('input[name="judul"]').addClass('is-invalid').focus();
                }
                
                // Validasi deskripsi
                const deskripsi = $('textarea[name="deskripsi"]').val().trim();
                if (!deskripsi) {
                    isValid = false;
                    $('textarea[name="deskripsi"]').addClass('is-invalid').focus();
                }
                
                // Validasi dosen (PENTING: format harus array dosen_selected[])
                if (!selected_dosen) {
                    isValid = false;
                    $('#dosen-section').addClass('border-danger');
                    $('#dosen-error-text').text('Harus memilih dosen pembimbing');
                    $('#dosen-error').show();
                    e.preventDefault();
                    return;
                } else {
                    $('#dosen-section').removeClass('border-danger');
                    $('#dosen-error').hide();
                }
                
                if (!isValid) {
                    e.preventDefault();
                    // Tampilkan pesan error umum
                    if (!judul || !deskripsi) {
                        alert('Harap lengkapi semua field yang wajib diisi (*)');
                    }
                    return;
                }
                
                // Validasi jumlah anggota
                if (mahasiswa_team_list.length > 5) {
                    e.preventDefault();
                    alert('Maksimal anggota tim adalah 5 orang.');
                    return;
                }
                
                // Show loading state
                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.prop('disabled', true);
                submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span> Menyimpan...');
                
                // Show toast notification
                const loadingToast = new bootstrap.Toast(document.getElementById('loadingToast'));
                loadingToast.show();
                
                // Form akan submit secara normal jika semua validasi passed
            });
            
            // Remove invalid class on focus
            $('.custom-input, .custom-textarea').on('focus', function() {
                $(this).removeClass('is-invalid');
                $(this).parent().addClass('focused');
            }).on('blur', function() {
                $(this).parent().removeClass('focused');
            });
            
            // Tampilkan error dari session jika ada
            @if(session('error'))
                setTimeout(() => {
                    alert('{{ session('error') }}');
                }, 500);
            @endif
        });

        // Tambahkan style untuk efek focus dan invalid state
        const style = document.createElement('style');
        style.textContent = `
            .focused .input-label {
                color: var(--primary);
            }
            .focused .custom-input,
            .focused .custom-textarea {
                border-color: var(--primary);
                background: white;
            }
            .is-invalid {
                border-color: var(--danger) !important;
                background: #fff5f5 !important;
            }
            .is-invalid:focus {
                box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
            }
            .border-danger {
                border-color: var(--danger) !important;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>