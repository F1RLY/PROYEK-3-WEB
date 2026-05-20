@extends('admin.admin', ['title' => 'Proyek'])

@section('content')

    <div class="mb-6">
        <h2 class="text-xl font-bold text-[#1B2559]">Semua Proyek</h2>
        <p class="text-sm text-[#A3AED0] mt-1">Daftar seluruh proyek yang telah diupload mahasiswa</p>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('admin.proyek') }}"
        class="bg-white rounded-[20px] shadow-sm p-4 mb-6 flex flex-wrap gap-3 items-end">

        {{-- Search --}}
        <div class="flex-1 min-w-[200px]">
            <label class="text-xs font-semibold text-[#A3AED0] mb-1 block">Cari Proyek</label>
            <div class="flex items-center gap-2 bg-[#F4F7FE] rounded-xl px-3 py-2">
                <span class="material-icons-round text-[#A3AED0] text-[18px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul proyek..."
                    class="bg-transparent text-sm text-[#1B2559] outline-none w-full placeholder-[#A3AED0]">
            </div>
        </div>

        {{-- Filter Status --}}
        <div class="min-w-[160px]">
            <label class="text-xs font-semibold text-[#A3AED0] mb-1 block">Status</label>
            <select name="status"
                class="w-full bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-3 py-2 outline-none">
                <option value="">Semua Status</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Menunggu</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Disetujui</option>
                <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        {{-- Filter Tahun --}}
        <div class="min-w-[140px]">
            <label class="text-xs font-semibold text-[#A3AED0] mb-1 block">Tahun</label>
            <select name="tahun"
                class="w-full bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-3 py-2 outline-none">
                <option value="">Semua Tahun</option>
                @foreach($tahuns as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-2">
            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 bg-[color:var(--primary)] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition">
                <span class="material-icons-round text-[16px]">filter_list</span>
                Filter
            </button>
            @if(request()->hasAny(['search', 'status', 'tahun']))
                <a href="{{ route('admin.proyek') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-[#F4F7FE] text-[#A3AED0] text-sm font-semibold rounded-xl hover:text-[#1B2559] transition">
                    <span class="material-icons-round text-[16px]">close</span>
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- STATS --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-[20px] shadow-sm p-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50">
                <span class="material-icons-round text-[color:var(--primary)] text-[22px]">folder</span>
            </div>
            <div>
                <p class="text-xs text-[#A3AED0]">Total Proyek</p>
                <p class="text-xl font-bold text-[#1B2559]">{{ $proyeks->total() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-[20px] shadow-sm p-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-green-50">
                <span class="material-icons-round text-green-500 text-[22px]">check_circle</span>
            </div>
            <div>
                <p class="text-xs text-[#A3AED0]">Disetujui</p>
                <p class="text-xl font-bold text-[#1B2559]">{{ \App\Models\Proyek::where('verifikasi', 1)->count() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-[20px] shadow-sm p-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-yellow-50">
                <span class="material-icons-round text-yellow-500 text-[22px]">hourglass_empty</span>
            </div>
            <div>
                <p class="text-xs text-[#A3AED0]">Menunggu</p>
                <p class="text-xl font-bold text-[#1B2559]">{{ \App\Models\Proyek::where('verifikasi', 0)->count() }}</p>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-[24px] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#F4F7FE]">
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">#</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Proyek</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Dosen</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Anggota</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Tahun</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Status</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F4F7FE]">
                    @forelse($proyeks as $proyek)
                        <tr class="hover:bg-[#F4F7FE] transition">
                            <td class="px-6 py-4 text-[#A3AED0]">
                                {{ ($proyeks->currentPage() - 1) * $proyeks->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 shrink-0">
                                        <span class="material-icons-round text-[color:var(--primary)] text-[18px]">rocket_launch</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-[#1B2559] max-w-[220px] truncate">{{ $proyek->judul }}</p>
                                        <p class="text-xs text-[#A3AED0]">{{ $proyek->repoCode }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#1B2559]">
                                {{ $proyek->dosen?->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex -space-x-2">
                                    @foreach($proyek->kelompok->take(3) as $k)
                                        @php
                                            $nama = $k->nama ?? $k->anggota?->user?->username ?? '?';
                                        @endphp
                                        <div title="{{ $nama }}"
                                            class="flex items-center justify-center w-8 h-8 rounded-full bg-[color:var(--primary)] text-white text-xs font-bold border-2 border-white">
                                            {{ strtoupper(substr($nama, 0, 1)) }}
                                        </div>
                                    @endforeach
                                    @if($proyek->kelompok->count() > 3)
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#F4F7FE] text-[#A3AED0] text-xs font-bold border-2 border-white">
                                            +{{ $proyek->kelompok->count() - 3 }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#1B2559]">
                                {{ $proyek->created_at->format('Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($proyek->verifikasi == 0)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">Menunggu</span>
                                @elseif($proyek->verifikasi == 1)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">Disetujui</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.verifikasi.detail', $proyek->id) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-[#F4F7FE] text-[color:var(--primary)] text-xs font-semibold hover:bg-blue-50 transition">
                                    <span class="material-icons-round text-[14px]">visibility</span>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-2 text-[#A3AED0]">
                                    <span class="material-icons-round text-5xl">folder_off</span>
                                    <p class="text-sm font-medium">Tidak ada proyek ditemukan</p>
                                    @if(request()->hasAny(['search', 'status', 'tahun']))
                                        <a href="{{ route('admin.proyek') }}" class="text-xs text-[color:var(--primary)] hover:underline">Reset filter</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($proyeks->hasPages())
            <div class="px-6 py-4 border-t border-[#F4F7FE] flex items-center justify-between">
                <p class="text-xs text-[#A3AED0]">
                    Menampilkan {{ $proyeks->firstItem() }}–{{ $proyeks->lastItem() }} dari {{ $proyeks->total() }} proyek
                </p>
                <div class="flex items-center gap-1">
                    {{-- Prev --}}
                    @if($proyeks->onFirstPage())
                        <span class="px-3 py-1.5 rounded-xl text-xs text-[#A3AED0] bg-[#F4F7FE] cursor-not-allowed">
                            <span class="material-icons-round text-[14px]">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $proyeks->previousPageUrl() }}"
                            class="px-3 py-1.5 rounded-xl text-xs text-[#1B2559] bg-[#F4F7FE] hover:bg-blue-50 transition">
                            <span class="material-icons-round text-[14px]">chevron_left</span>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($proyeks->getUrlRange(1, $proyeks->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold transition
                                {{ $page == $proyeks->currentPage()
                                    ? 'bg-[color:var(--primary)] text-white'
                                    : 'text-[#1B2559] bg-[#F4F7FE] hover:bg-blue-50' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    {{-- Next --}}
                    @if($proyeks->hasMorePages())
                        <a href="{{ $proyeks->nextPageUrl() }}"
                            class="px-3 py-1.5 rounded-xl text-xs text-[#1B2559] bg-[#F4F7FE] hover:bg-blue-50 transition">
                            <span class="material-icons-round text-[14px]">chevron_right</span>
                        </a>
                    @else
                        <span class="px-3 py-1.5 rounded-xl text-xs text-[#A3AED0] bg-[#F4F7FE] cursor-not-allowed">
                            <span class="material-icons-round text-[14px]">chevron_right</span>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>

@endsection