@extends('admin.admin', ['title' => 'Verifikasi Proyek'])

@section('content')

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-bold text-[#1B2559]">Proyek Menunggu Verifikasi</h3>
            <p class="text-sm text-[#A3AED0]">{{ $proyeks->count() }} proyek menunggu persetujuan</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[24px] shadow-sm overflow-hidden">
        @if($proyeks->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-[#A3AED0]">
                <span class="material-icons-round text-6xl mb-3">task_alt</span>
                <p class="font-medium">Semua proyek sudah diverifikasi!</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#F4F7FE]">
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">No</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Judul Proyek</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Dosen</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Tanggal Upload</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Status</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F4F7FE]">
                    @foreach($proyeks as $i => $proyek)
                        <tr class="hover:bg-[#F4F7FE]/50 transition">

                            <td class="px-6 py-4 text-[#A3AED0]">{{ $i + 1 }}</td>

                            <td class="px-6 py-4">
                                <p class="font-semibold text-[#1B2559]">{{ $proyek->judul }}</p>
                                <p class="text-xs text-[#A3AED0] mt-0.5 line-clamp-1">{{ $proyek->deskripsi }}</p>
                            </td>

                            <td class="px-6 py-4 text-[#1B2559]">
                                {{ $proyek->dosen?->nama ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-[#A3AED0]">
                                {{ \Carbon\Carbon::parse($proyek->created_at)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">
                                    Menunggu
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    <!-- Setujui -->
                                    <form method="POST" action="{{ route('admin.verifikasi.setujui', $proyek->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-1 px-3 py-1.5 rounded-xl bg-green-500 text-white text-xs font-semibold hover:bg-green-600 transition">
                                            <span class="material-icons-round text-[14px]">check</span>
                                            Setujui
                                        </button>
                                    </form>

                                    <!-- Tolak -->
                                    <form method="POST" action="{{ route('admin.verifikasi.tolak', $proyek->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-1 px-3 py-1.5 rounded-xl bg-red-500 text-white text-xs font-semibold hover:bg-red-600 transition">
                                            <span class="material-icons-round text-[14px]">close</span>
                                            Tolak
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.verifikasi.detail', $proyek->id) }}"
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-xl bg-[#F4F7FE] text-[#1B2559] text-xs font-semibold hover:bg-[color:var(--primary)] hover:text-white transition">
                                        <span class="material-icons-round text-[14px]">visibility</span>
                                        Detail
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection