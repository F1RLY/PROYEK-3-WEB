<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RepoTI - Admin Panel</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Font & Custom Style -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #1DA1F2;
            --primary-dark: #0d8bd9;
            --secondary: #40C4FF;
            --dark: #2D3142;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .logo-repo {
            color: var(--dark);
        }

        .logo-ti {
            color: var(--primary);
            margin-left: 2px;
        }
    </style>
</head>

<body class="bg-[#F4F7FE] text-[#1B2559]">
    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="hidden md:flex flex-col w-64 h-screen sticky top-0 bg-white border-r border-gray-100">

            <!-- Logo -->
            <div class="flex items-center justify-center p-8">
                <h1 class="text-3xl font-extrabold tracking-tight select-none">
                    <span class="logo-repo">Repo</span><span class="logo-ti">TI</span>
                </h1>
            </div>

            <!-- Menu -->
            <nav class="flex-1 px-4 mt-2">
                @php
                    $menus = [
                        ['title' => 'Dashboard', 'icon' => 'grid_view', 'route' => 'admin.dashboard'],
                        ['title' => 'Expo', 'icon' => 'calendar_today', 'route' => 'admin.expo'],
                        ['title' => 'Proyek', 'icon' => 'assignment', 'route' => 'admin.proyek'],
                        ['title' => 'Dosen', 'icon' => 'supervised_user_circle', 'route' => 'admin.dosen'],
                        ['title' => 'User', 'icon' => 'person', 'route' => 'admin.user'],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    <a href="{{ route($menu['route']) }}"
                       class="flex items-center gap-4 px-4 py-3 mb-2 rounded-xl font-bold transition-all
                       {{ Route::is($menu['route']) 
                            ? 'bg-[color:var(--primary)]/10 text-[color:var(--primary)]' 
                            : 'text-[#A3AED0] hover:bg-gray-50' }}">

                        <span class="material-icons-round text-[22px]">
                            {{ $menu['icon'] }}
                        </span>

                        <span class="text-sm">
                            {{ $menu['title'] }}
                        </span>
                    </a>
                @endforeach
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full gap-4 px-4 py-3 font-bold text-red-500 rounded-xl transition hover:bg-red-50">
                        
                        <span class="material-icons-round">logout</span>
                        <span class="text-sm">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>


        <!-- MAIN -->
        <main class="flex flex-col flex-1">

            <!-- HEADER -->
            <header class="sticky top-0 z-10 flex items-center justify-between px-8 py-4 bg-white/80 backdrop-blur-md">

                <!-- Title -->
                <div>
                    <p class="text-xs font-medium text-[#A3AED0]">
                        Main Menu / {{ $title ?? 'Dashboard' }}
                    </p>
                    <h2 class="text-3xl font-bold">
                        {{ $title ?? 'Dashboard' }}
                    </h2>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 px-4 py-2 bg-[#F4F7FE] rounded-full shadow-inner">

                    <!-- Search -->
                    <div class="flex items-center gap-2 px-3 py-1 bg-white rounded-full shadow-sm">
                        <span class="material-icons-round text-[#A3AED0] text-[18px]">
                            search
                        </span>

                        <input type="text"
                               placeholder="Search..."
                               class="w-24 text-sm bg-transparent outline-none border-none">
                    </div>

                    <!-- Profile -->
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-[color:var(--primary)]/20 cursor-pointer">
                        <span class="material-icons-round text-[color:var(--primary)] text-[20px]">
                            person
                        </span>
                    </div>

                </div>
            </header>

            <!-- CONTENT -->
            <section class="p-8">
                @yield('content')
            </section>

        </main>
    </div>
</body>
</html>