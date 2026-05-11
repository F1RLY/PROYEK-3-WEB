@extends('admin.admin', ['title' => 'Detail Verifikasi'])

{{-- <pre style="font-size:11px; background:#f4f4f4; padding:16px; border-radius:12px; overflow:auto;">
{{ json_encode([
    'judul'       => $proyek->judul,
    'link'        => $proyek->link,
    'file_laporan'=> $proyek->file_laporan,
    'file_ppt'    => $proyek->file_ppt,
    'gambars'     => $proyek->gambars->pluck('lokasi'),
    'kelompok'    => $proyek->kelompok->map(fn($k) => [
        'mahasiswa' => $k->mahasiswa?->user?->username ?? 'NULL',
        'nim'       => $k->mahasiswa?->user?->kode ?? 'NULL',
    ]),
], JSON_PRETTY_PRINT) }}
</pre> --}}

@section('content')

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- BACK -->
    <a href="{{ route('admin.verifikasi') }}"
        class="inline-flex items-center gap-2 text-sm text-[#A3AED0] hover:text-[#1B2559] mb-6 transition">
        <span class="material-icons-round text-[18px]">arrow_back</span>
        Kembali ke Verifikasi
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KIRI: Info Proyek -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Gambar -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Gambar Proyek</h4>
               @if($proyek->gambars->isEmpty())
                    <div class="flex items-center justify-center h-40 rounded-2xl bg-[#F4F7FE] text-[#A3AED0]">
                        <div class="text-center">
                            <span class="material-icons-round text-4xl">image_not_supported</span>
                            <p class="text-sm mt-1">Tidak ada gambar</p>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($proyek->gambars as $gambar)
                            <img src="{{ asset('images/proyek/' . $gambar->lokasi) }}"
                                class="w-full h-48 object-cover rounded-2xl"
                                alt="Gambar Proyek"
                                onerror="this.src='https://placehold.co/400x200?text=Gambar+Error'">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Judul & Deskripsi -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Informasi Proyek</h4>

                <h2 class="text-xl font-bold text-[#1B2559] mb-2">{{ $proyek->judul }}</h2>
                <p class="text-sm text-[#A3AED0] leading-relaxed">{{ $proyek->deskripsi }}</p>

                <div class="mt-4">
                    <p class="text-xs font-medium text-[#A3AED0] mb-1">Link Proyek</p>
                    @if($proyek->link)
                        <a href="{{ $proyek->link }}" target="_blank"
                            class="inline-flex items-center gap-2 text-sm text-[color:var(--primary)] font-medium hover:underline">
                            <span class="material-icons-round text-[16px]">link</span>
                            {{ $proyek->link }}
                        </a>
                    @else
                        <p class="text-sm text-[#A3AED0] italic">Tidak ada link</p>
                    @endif
                </div>
            </div>

            <!-- File -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">File Dokumen</h4>
                <div class="space-y-3">

                    <!-- Laporan -->
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-[#F4F7FE]">
                        <div class="flex items-center gap-3">
                            <span class="material-icons-round text-[#A3AED0]">description</span>
                            <span class="text-sm font-medium text-[#1B2559]">File Laporan</span>
                        </div>
                        @if($proyek->file_laporan)
                            <a href="{{ asset('files/laporan/' . $proyek->file_laporan) }}" target="_blank"
                                class="text-xs font-semibold text-[color:var(--primary)] hover:underline">
                                Download
                            </a>
                        @else
                            <span class="text-xs text-[#A3AED0]">Belum ada</span>
                        @endif
                    </div>

                    <!-- PPT -->
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-[#F4F7FE]">
                        <div class="flex items-center gap-3">
                            <span class="material-icons-round text-[#A3AED0]">slideshow</span>
                            <span class="text-sm font-medium text-[#1B2559]">File PPT</span>
                        </div>
                        @if($proyek->file_ppt)
                            <a href="{{ asset('files/ppt/' . $proyek->file_ppt) }}" target="_blank"
                                class="text-xs font-semibold text-[color:var(--primary)] hover:underline">
                                Download
                            </a>
                        @else
                            <span class="text-xs text-[#A3AED0]">Belum ada</span>
                        @endif
                    </div>

                </div>
            </div>
            
            <!-- Video -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Video Proyek</h4>

                @if($proyek->videos->isEmpty())
                    <div class="flex items-center justify-center h-24 rounded-2xl bg-[#F4F7FE] text-[#A3AED0]">
                        <div class="text-center">
                            <span class="material-icons-round text-3xl">videocam_off</span>
                            <p class="text-sm mt-1">Tidak ada video</p>
                        </div>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($proyek->videos as $video)
                            @php
                                $lokasi  = $video->lokasi;
                                $isUrl   = str_starts_with($lokasi, 'http');
                                $isYt    = str_contains($lokasi, 'youtube.com') || str_contains($lokasi, 'youtu.be');
                                $isFile  = !$isUrl;

                                // Ambil YouTube embed ID
                                $ytId = null;
                                if ($isYt) {
                                    preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $lokasi, $m);
                                    $ytId = $m[1] ?? null;
                                }
                            @endphp

                            <div class="rounded-2xl bg-[#F4F7FE] overflow-hidden">

                                {{-- YouTube embed --}}
                                @if($isYt && $ytId)
                                    <div class="relative w-full" style="padding-top: 56.25%">
                                        <iframe
                                            class="absolute inset-0 w-full h-full rounded-t-2xl"
                                            src="https://www.youtube.com/embed/{{ $ytId }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="flex items-center gap-2 px-4 py-3">
                                        <span class="material-icons-round text-red-500 text-[18px]">smart_display</span>
                                        <span class="text-xs font-medium text-[#1B2559] truncate">{{ $lokasi }}</span>
                                        <a href="{{ $lokasi }}" target="_blank"
                                            class="ml-auto text-xs font-semibold text-[color:var(--primary)] hover:underline shrink-0">
                                            Buka
                                        </a>
                                    </div>

                                {{-- URL eksternal (bukan YouTube) --}}
                                @elseif($isUrl)
                                    <div class="flex items-center gap-3 px-4 py-4">
                                        <span class="material-icons-round text-[color:var(--primary)] text-[22px]">link</span>
                                        <span class="text-sm text-[#1B2559] truncate flex-1">{{ $lokasi }}</span>
                                        <a href="{{ $lokasi }}" target="_blank"
                                            class="text-xs font-semibold text-[color:var(--primary)] hover:underline shrink-0">
                                            Buka
                                        </a>
                                    </div>

                                {{-- File video lokal --}}
                                @else
                                    <video controls class="w-full rounded-t-2xl max-h-64 bg-black">
                                        <source src="{{ asset('files/video/' . $lokasi) }}" type="video/mp4">
                                        Browser tidak mendukung video.
                                    </video>
                                    <div class="flex items-center gap-2 px-4 py-3">
                                        <span class="material-icons-round text-[color:var(--primary)] text-[18px]">video_file</span>
                                        <span class="text-xs font-medium text-[#1B2559] truncate">{{ $lokasi }}</span>
                                        <a href="{{ asset('files/video/' . $lokasi) }}" target="_blank"
                                            class="ml-auto text-xs font-semibold text-[color:var(--primary)] hover:underline shrink-0">
                                            Download
                                        </a>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        <!-- KANAN: Info Tambahan + Aksi -->
        <div class="space-y-6">

            <!-- Status -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Status</h4>
                <div class="space-y-3">

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-[#A3AED0]">Verifikasi</span>
                        @if($proyek->verifikasi == 0)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">Menunggu</span>
                        @elseif($proyek->verifikasi == 1)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">Disetujui</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">Ditolak</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-[#A3AED0]">Proposal / PPT</span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $proyek->file_ppt ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                            {{ $proyek->file_ppt ? 'Ada' : 'Belum ada' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-[#A3AED0]">Laporan</span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $proyek->file_laporan ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                            {{ $proyek->file_laporan ? 'Ada' : 'Belum ada' }}
                        </span>
                    </div>

                </div>
            </div>

            <!-- Dosen -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Dosen Pembimbing</h4>
                @if($proyek->dosen)
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#F4F7FE] text-[color:var(--primary)]">
                            <span class="material-icons-round text-[20px]">school</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-[#1B2559]">{{ $proyek->dosen->nama }}</p>
                            <p class="text-xs text-[#A3AED0]">{{ $proyek->dosen->NIP }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-[#A3AED0]">Belum ditentukan</p>
                @endif
            </div>

            <!-- Anggota -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Anggota Kelompok</h4>
                <div class="space-y-3">
                    @forelse($proyek->kelompok as $k)
                        @php
                            $namaAnggota = $k->nama ?? $k->anggota?->user?->username ?? '-';
                        @endphp
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-9 h-9 rounded-full bg-[#F4F7FE] text-[color:var(--primary)] text-sm font-bold">
                                {{ strtoupper(substr($namaAnggota, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-[#1B2559]">{{ $namaAnggota }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[#A3AED0]">Tidak ada anggota</p>
                    @endforelse
                </div>
            </div>

            <!-- AKSI -->
            @if($proyek->verifikasi == 0)
                <div class="bg-white rounded-[24px] shadow-sm p-6 space-y-3">
                    <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Keputusan</h4>

                    <form method="POST" action="{{ route('admin.verifikasi.setujui', $proyek->id) }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-green-500 text-white font-semibold text-sm hover:bg-green-600 transition">
                            <span class="material-icons-round text-[18px]">check_circle</span>
                            Setujui Proyek
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.verifikasi.tolak', $proyek->id) }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-red-500 text-white font-semibold text-sm hover:bg-red-600 transition">
                            <span class="material-icons-round text-[18px]">cancel</span>
                            Tolak Proyek
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>

@endsection