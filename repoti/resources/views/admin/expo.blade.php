@extends('admin.admin', ['title' => 'Expo'])

@section('content')

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 px-5 py-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-[#1B2559]">Manajemen Expo</h3>
            <p class="text-sm text-[#A3AED0]">Kelola pameran proyek mahasiswa</p>
        </div>
        <a href="{{ route('admin.expo.create') }}"
            class="flex items-center gap-2 px-5 py-2.5 bg-[color:var(--primary)] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition">
            <span class="material-icons-round text-[18px]">add</span>
            Buat Expo
        </a>
    </div>

    <!-- LIST EXPO -->
    @if($expos->isEmpty())
        <div class="bg-white rounded-[24px] shadow-sm flex flex-col items-center justify-center py-24 text-[#A3AED0]">
            <span class="material-icons-round text-6xl mb-3">event_busy</span>
            <p class="font-medium">Belum ada expo</p>
            <a href="{{ route('admin.expo.create') }}"
                class="mt-4 px-5 py-2 bg-[color:var(--primary)] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition">
                Buat Expo Pertama
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($expos as $expo)
                @php
                    $statusColor = match($expo->status) {
                        'active' => 'bg-green-100 text-green-600',
                        'ended'  => 'bg-gray-100 text-gray-500',
                        default  => 'bg-yellow-100 text-yellow-600',
                    };
                    $statusLabel = match($expo->status) {
                        'active' => 'Berlangsung',
                        'ended'  => 'Selesai',
                        default  => 'Draft',
                    };
                @endphp

                <div class="bg-white rounded-[24px] shadow-sm p-6 flex flex-col gap-4">

                    <!-- Status & Tanggal -->
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                            {{ $statusLabel }}
                        </span>
                        <span class="text-xs text-[#A3AED0]">
                            {{ \Carbon\Carbon::parse($expo->tanggal_mulai)->format('d M Y') }}
                        </span>
                    </div>

                    <!-- Nama & Deskripsi -->
                    <div>
                        <h4 class="text-base font-bold text-[#1B2559]">{{ $expo->nama }}</h4>
                        <p class="text-sm text-[#A3AED0] mt-1 line-clamp-2">
                            {{ $expo->deskripsi ?? 'Tidak ada deskripsi' }}
                        </p>
                    </div>

                    <!-- Info -->
                    <div class="flex items-center gap-4 text-xs text-[#A3AED0]">
                        <div class="flex items-center gap-1">
                            <span class="material-icons-round text-[14px]">rocket_launch</span>
                            {{ $expo->proyeks_count }} Proyek
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="material-icons-round text-[14px]">schedule</span>
                            s/d {{ \Carbon\Carbon::parse($expo->tanggal_selesai)->format('d M Y') }}
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="flex items-center gap-2 pt-2 border-t border-[#F4F7FE]">

                        <a href="{{ route('admin.expo.show', $expo->id) }}"
                            class="flex-1 flex items-center justify-center gap-1 py-2 rounded-xl bg-[#F4F7FE] text-[#1B2559] text-xs font-semibold hover:bg-blue-50 hover:text-[color:var(--primary)] transition">
                            <span class="material-icons-round text-[14px]">settings</span>
                            Kelola
                        </a>

                        @if($expo->status == 'draft')
                            <form method="POST" action="{{ route('admin.expo.start', $expo->id) }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-1 px-3 py-2 rounded-xl bg-green-500 text-white text-xs font-semibold hover:bg-green-600 transition">
                                    <span class="material-icons-round text-[14px]">play_arrow</span>
                                    Start
                                </button>
                            </form>
                        @elseif($expo->status == 'active')
                            <form method="POST" action="{{ route('admin.expo.stop', $expo->id) }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-1 px-3 py-2 rounded-xl bg-red-500 text-white text-xs font-semibold hover:bg-red-600 transition">
                                    <span class="material-icons-round text-[14px]">stop</span>
                                    Stop
                                </button>
                            </form>
                        @else
                            <a href="{{ route('admin.expo.hasil', $expo->id) }}"
                                class="flex items-center gap-1 px-3 py-2 rounded-xl bg-[color:var(--primary)] text-white text-xs font-semibold hover:opacity-90 transition">
                                <span class="material-icons-round text-[14px]">bar_chart</span>
                                Hasil
                            </a>
                        @endif

                        <form method="POST" action="{{ route('admin.expo.destroy', $expo->id) }}"
                            onsubmit="return confirm('Yakin hapus expo {{ addslashes($expo->nama) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center justify-center w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition">
                                <span class="material-icons-round text-[16px]">delete</span>
                            </button>
                        </form>

                    </div>
                </div>
            @endforeach
        </div>

        @if($expos->hasPages())
            <div class="mt-6">{{ $expos->links() }}</div>
        @endif
    @endif

@endsection