<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            
            <a href="{{ url('/') }}" class="back-btn">
                ← Kembali
            </a>

            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo">
            <h2>Daftar Akun Mahasiswa</h2>
            
            @if (session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert error">
                    Pendaftaran gagal! Silakan periksa kembali semua isian Anda.
                </div>
            @endif
            
            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="form-grid-container">
                    
                    <h3 class="form-section-title full-width">Informasi Akun Anda</h3>

                    {{-- KOLOM KIRI (Data Diri & Identitas) --}}
                    <div class="form-column-left">
                        
                        <div class="input-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                            @error('nama') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="input-group">
                            <label for="nim">NIM (Nomor Induk Mahasiswa)</label>
                            <input type="text" id="nim" name="nim" placeholder="Contoh: 2021081001" value="{{ old('nim') }}" required>
                            @error('nim') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email aktif" value="{{ old('email') }}" required>
                            @error('email') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="input-group">
                            <label for="angkatan">Angkatan (Tahun Masuk)</label>
                            <input type="number" id="angkatan" name="angkatan" placeholder="Contoh: 2023" value="{{ old('angkatan') }}" required>
                            @error('angkatan') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    {{-- KOLOM KANAN (Data Akademik & Keamanan) --}}
                    <div class="form-column-right">
                        
                        <div class="input-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" id="kelas" name="kelas" placeholder="Contoh: B" value="{{ old('kelas') }}" required>
                            @error('kelas') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Buat password (min 6 karakter)" required>
                            @error('password') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="input-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password Anda" required>
                        </div>
                        
                    </div>
                    
                </div>
                
                <button type="submit" class="btn-login">Daftar Sekarang</button>
                
                <p class="login-link-text">
                    Sudah punya akun? <a href="{{ route('login') }}" class="login-link">Login di sini</a>
                </p>

            </form>
        </div>
    </div>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgba(30,60,114,0.8), rgba(42,82,152,0.6)),
                        url('{{ asset('image/gsc.jpg') }}') no-repeat center center/cover;
            /* UBAH: Gunakan min-height dan tambahkan padding body agar bisa scroll normal */
            min-height: 100vh;
            padding: 20px 0; 
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            /* Hapus tinggi atau batasan tinggi dari container agar bisa menyesuaikan */
        }

        .login-card {
            position: relative;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            padding: 50px 40px; 
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
            max-width: 650px; 
            width: 90%; 
            color: #fff;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            /* PENTING: Hapus batasan tinggi yang memicu scroll ganda */
            /* max-height dan overflow-y dihilangkan di sini */
        }
        
        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: 500;
            text-align: center;
        }

        .alert.error {
            background-color: rgba(255, 0, 0, 0.1);
            color: #ff5555;
            border: 1px solid rgba(255, 0, 0, 0.3);
        }
        
        .validation-error {
            display: block;
            color: #ff6666;
            font-size: 12px;
            margin-top: 4px;
        }
        
        .back-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            height: 40px;
            display: flex;
            align-items: center;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .logo {
            width: 90px;
            height: 90px;
            margin-bottom: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.2));
        }

        h2 {
            margin-bottom: 25px;
            letter-spacing: 1px;
            font-weight: 600;
            color: #fff;
        }

        /* --- CSS untuk Layout 2 Kolom (GRID) --- */
        .form-grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr; 
            gap: 30px; 
            margin-bottom: 20px;
            padding-right: 0; 
        }

        .full-width {
            grid-column: 1 / -1; 
        }

        .form-column-left {
            display: flex;
            flex-direction: column;
            gap: 0;
            position: relative;
        }
        
        .form-column-left::after {
            content: none; 
        }

        .form-column-right {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 600;
            color: #00d4ff;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 8px;
            margin-top: 5px;
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group {
            text-align: left;
            margin-bottom: 18px; 
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #f0f0f0;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            transition: border 0.3s;
        }

        input:focus {
            border: 2px solid #00d4ff;
            background-color: #fff;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #00d4ff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 25px;
        }

        .btn-login:hover {
            background-color: #00aee0;
        }
        
        .login-link-text {
            margin-top: 20px; 
            font-size: 14px; 
            color: #ccc;
        }
        
        .login-link {
            color: #00d4ff; 
            text-decoration: none; 
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: #88ffff;
        }


        /* --- Media Query untuk Responsif --- */
        @media (max-width: 768px) {
            .login-card {
                width: 90%;
                padding: 30px 20px;
                max-width: none;
            }

            .back-btn {
                font-size: 13px;
                padding: 5px 8px;
            }

            h2 {
                font-size: 20px;
            }

            input, .btn-login {
                font-size: 14px;
            }
            
            .form-grid-container {
                grid-template-columns: 1fr; 
                gap: 0;
                padding-right: 0;
            }
            
            .form-column-left {
                margin-bottom: 10px; 
            }
            
            .form-section-title {
                font-size: 15px;
            }
        }
    </style>
</body>
</html>