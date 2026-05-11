<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} — Repo TI</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4318FF;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #F4F7FE;
        }
    </style>
</head>
<body class="min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="ml-64 min-h-screen p-8">

        {{-- TOPBAR --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-[#1B2559]">{{ $title ?? 'Dashboard' }}</h2>
                <p class="text-sm text-[#A3AED0]">Selamat datang, {{ Auth::user()->username }}!</p>
            </div>

            <div class="flex items-center gap-3">
                <!-- Notif -->
                <button class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-sm text-[#A3AED0] hover:text-[color:var(--primary)] transition">
                    <span class="material-icons-round text-[20px]">notifications</span>
                </button>

                <!-- Avatar -->
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[color:var(--primary)] text-white text-sm font-bold shadow-sm">
                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                </div>
            </div>
        </div>

        {{-- PAGE CONTENT --}}
        @yield('content')

    </main>

</body>
</html>