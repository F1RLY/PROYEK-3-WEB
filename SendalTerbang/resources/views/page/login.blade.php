<head>
    <title>DaksaWidya</title>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <a href="{{ url('/') }}" class="back-btn">
                ⬅ Kembali
            </a>

            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo">
            <h2>Verifikasi Akun</h2>
            
            {{-- Pesan Sukses (Misalnya, setelah berhasil Registrasi) --}}
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan Error dari Controller --}}
            @if (session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username / email / NIM" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>
            
            {{-- TAUTAN BARU KE HALAMAN REGISTRASI --}}
            <p class="register-link-text">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="register-link">Daftar sekarang</a>
            </p>
            {{-- AKHIR TAUTAN BARU --}}

        </div>
    </div>

    <style>
        /* Latar belakang */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgba(30,60,114,0.8), rgba(42,82,152,0.6)),
                        url('{{ asset('image/gsc.jpg') }}') no-repeat center center/cover;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Utility styles untuk pesan */
        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: 500;
            text-align: center;
        }

        /* Style untuk pesan sukses (alert-success sudah ada dari Anda) */
        .alert-success {
            background-color: rgba(0, 255, 0, 0.1);
            color: #00ff99;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid rgba(0, 255, 0, 0.3);
            text-align: center;
            font-weight: 500;
        }
        
        /* Style untuk pesan error */
        .alert.error {
            background-color: rgba(255, 0, 0, 0.1);
            color: #ff5555;
            border: 1px solid rgba(255, 0, 0, 0.3);
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* Kartu login */
        .login-card {
            position: relative;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            padding: 45px 35px;
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
            width: 380px;
            color: #fff;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Tombol kembali */
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

        .input-group {
            text-align: left;
            margin-bottom: 20px;
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
            border: 1px solid transparent; /* Border default transparan */
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
        }

        .btn-login:hover {
            background-color: #00aee0;
        }

        /* Style untuk Link Registrasi */
        .register-link-text {
            margin-top: 20px; 
            font-size: 14px; 
            color: #ccc;
        }
        
        .register-link {
            color: #00d4ff; 
            text-decoration: none; 
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link:hover {
            color: #88ffff;
        }

        /* Responsif untuk HP */
        @media (max-width: 480px) {
            .login-card {
                width: 90%;
                padding: 30px 20px;
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
        }
    </style>
</body>