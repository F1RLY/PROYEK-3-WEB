@extends('admin.admin', ['title' => 'Detail User'])

@section('content')

    <!-- BACK -->
    <a href="{{ route('admin.user') }}"
        class="inline-flex items-center gap-2 text-sm text-[#A3AED0] hover:text-[#1B2559] mb-6 transition">
        <span class="material-icons-round text-[18px]">arrow_back</span>
        Kembali ke User
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KIRI: Info User -->
        <div class="space-y-6">

            <!-- Profile Card -->
            <div class="bg-white rounded-[24px] shadow-sm p-6 flex flex-col items-center text-center">
                @if($user->foto)
                    <img src="{{ asset('image/' . $user->foto) }}"
                        class="w-24 h-24 rounded-full object-cover mb-4">
                @else
                    <div class="flex items-center justify-center w-24 h-24 rounded-full bg-[color:var(--primary)] text-white text-3xl font-bold mb-4">
                        {{ strtoupper(substr($user->username, 0, 1)) }}
                    </div>
                @endif

                <h3 class="text-lg font-bold text-[#1B2559]">{{ $user->username }}</h3>
                <p class="text-sm text-[#A3AED0]">{{ $user->email }}</p>

                @php
                    $roleColor = match($user->role) {
                        'admin'  => 'bg-purple-100 text-purple-600',
                        'dosen'  => 'bg-blue-100 text-blue-600',
                        default  => 'bg-[#F4F7FE] text-[#1B2559]',
                    };
                @endphp
                <span class="mt-3 px-4 py-1 rounded-full text-xs font-semibold {{ $roleColor }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>

            <!-- Info Detail -->
            <div class="bg-white rounded-[24px] shadow-sm p-6 space-y-4">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide">Informasi Akun</h4>

                <div>
                    <p class="text-xs text-[#A3AED0]">NIM / Kode</p>
                    <p class="text-sm font-semibold text-[#1B2559]">{{ $user->kode ?? '-' }}</p>
                </div>

                @if($user->mahasiswa)
                    <div>
                        <p class="text-xs text-[#A3AED0]">Angkatan</p>
                        <p class="text-sm font-semibold text-[#1B2559]">{{ $user->mahasiswa->angkatan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#A3AED0]">Kelas</p>
                        <p class="text-sm font-semibold text-[#1B2559]">{{ strtoupper($user->mahasiswa->kelas ?? '-') }}</p>
                    </div>
                    @if($user->mahasiswa->link)
                        <div>
                            <p class="text-xs text-[#A3AED0]">Link Portofolio</p>
                            <a href="{{ $user->mahasiswa->link }}" target="_blank"
                                class="text-sm text-[color:var(--primary)] hover:underline truncate block">
                                {{ $user->mahasiswa->link }}
                            </a>
                        </div>
                    @endif
                @endif

                <div>
                    <p class="text-xs text-[#A3AED0]">Bergabung</p>
                    <p class="text-sm font-semibold text-[#1B2559]">
                        {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}
                    </p>
                </div>
            </div>

        </div>

        <!-- KANAN: Proyek -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-6">Proyek</h4>

                @if($proyeks->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 text-[#A3AED0]">
                        <span class="material-icons-round text-5xl mb-3">folder_off</span>
                        <p class="text-sm">Belum ada proyek</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($proyeks as $proyek)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-[#F4F7FE]">
                                <div>
                                    <p class="font-semibold text-[#1B2559] text-sm">{{ $proyek->judul }}</p>
                                    <p class="text-xs text-[#A3AED0] mt-0.5">
                                        {{ \Carbon\Carbon::parse($proyek->created_at)->format('d M Y') }}
                                    </p>
                                </div>
                                @if($proyek->verifikasi == 1)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">Disetujui</span>
                                @elseif($proyek->verifikasi == 2)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">Ditolak</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">Menunggu</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection