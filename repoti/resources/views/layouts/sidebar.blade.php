<aside id="sidebar"
    class="fixed top-0 left-0 h-full w-64 bg-white shadow-md z-50 flex flex-col transition-transform duration-300">

    <!-- LOGO -->
    <div class="flex items-center gap-3 px-6 py-6 border-b border-gray-100">
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-[color:var(--primary)]">
            <span class="material-icons-round text-white text-xl">folder_special</span>
        </div>
        <div>
            <h1 class="text-base font-bold text-[#1B2559] leading-tight">Repo TI</h1>
            <p class="text-[10px] text-[#A3AED0]">Admin Panel</p>
        </div>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">

        @php
            $menus = [
                ['label' => 'Dashboard',    'icon' => 'dashboard',       'route' => 'admin.dashboard'],
                ['label' => 'Verifikasi',   'icon' => 'verified',        'route' => 'admin.verifikasi'],
                ['label' => 'Proyek',       'icon' => 'rocket_launch',   'route' => 'admin.proyek'],
                ['label' => 'User',       'icon' => 'people',        'route' => 'admin.user'],
                ['label' => 'Dosen',        'icon' => 'school',          'route' => 'admin.dosen'],
                ['label' => 'Expo',         'icon' => 'event',           'route' => 'admin.expo'],
            ];
        @endphp

        @foreach ($menus as $menu)
            @php
                $isActive = request()->routeIs($menu['route']);
            @endphp

            <a href="{{ route($menu['route']) }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200
                    {{ $isActive
                        ? 'bg-[color:var(--primary)] text-white shadow-md shadow-blue-200'
                        : 'text-[#A3AED0] hover:bg-[#F4F7FE] hover:text-[#1B2559]' }}">
                <span class="material-icons-round text-[20px]">{{ $menu['icon'] }}</span>
                {{ $menu['label'] }}
            </a>
        @endforeach

    </nav>

    <!-- USER INFO + LOGOUT -->
    <div class="px-4 py-4 border-t border-gray-100">
        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F4F7FE]">

            <!-- Avatar -->
            <div class="flex items-center justify-center w-9 h-9 rounded-full bg-[color:var(--primary)] text-white text-sm font-bold">
                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
            </div>

            <!-- Info -->
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-[#1B2559] truncate">{{ Auth::user()->username }}</p>
                <p class="text-[10px] text-[#A3AED0]">Administrator</p>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" title="Logout"
                    class="text-[#A3AED0] hover:text-red-500 transition">
                    <span class="material-icons-round text-[20px]">logout</span>
                </button>
            </form>

        </div>
    </div>

</aside>