@extends('admin.admin', ['title' => 'Detail Expo'])

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

    <!-- BACK -->
    <a href="{{ route('admin.expo') }}"
        class="inline-flex items-center gap-2 text-sm text-[#A3AED0] hover:text-[#1B2559] mb-6 transition">
        <span class="material-icons-round text-[18px]">arrow_back</span>
        Kembali ke Expo
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KIRI: Info Expo -->
        <div class="space-y-6">

            <!-- Info Card -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
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

                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                        {{ $statusLabel }}
                    </span>
                    <span class="text-xs text-[#A3AED0]">{{ $expo->proyeks->count() }} Proyek</span>
                </div>

                <h3 class="text-lg font-bold text-[#1B2559] mb-2">{{ $expo->nama }}</h3>
                <p class="text-sm text-[#A3AED0] mb-4">{{ $expo->deskripsi ?? 'Tidak ada deskripsi' }}</p>

                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2 text-[#A3AED0]">
                        <span class="material-icons-round text-[16px]">event</span>
                        Mulai: <span class="text-[#1B2559] font-medium">
                            {{ \Carbon\Carbon::parse($expo->tanggal_mulai)->format('d M Y, H:i') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-[#A3AED0]">
                        <span class="material-icons-round text-[16px]">event_busy</span>
                        Selesai: <span class="text-[#1B2559] font-medium">
                            {{ \Carbon\Carbon::parse($expo->tanggal_selesai)->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Aksi -->
            <div class="bg-white rounded-[24px] shadow-sm p-6 space-y-3">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">Aksi</h4>

                @if($expo->status == 'draft')
                    <form method="POST" action="{{ route('admin.expo.start', $expo->id) }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-green-500 text-white font-semibold text-sm hover:bg-green-600 transition">
                            <span class="material-icons-round text-[18px]">play_arrow</span>
                            Start Expo
                        </button>
                    </form>

                @elseif($expo->status == 'active')
                    <form method="POST" action="{{ route('admin.expo.stop', $expo->id) }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-red-500 text-white font-semibold text-sm hover:bg-red-600 transition">
                            <span class="material-icons-round text-[18px]">stop</span>
                            Stop Expo
                        </button>
                    </form>

                @else
                    <a href="{{ route('admin.expo.hasil', $expo->id) }}"
                        class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-[color:var(--primary)] text-white font-semibold text-sm hover:opacity-90 transition">
                        <span class="material-icons-round text-[18px]">bar_chart</span>
                        Lihat Hasil
                    </a>
                @endif

                <form method="POST" action="{{ route('admin.expo.destroy', $expo->id) }}"
                    onsubmit="return confirm('Yakin hapus expo ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-red-50 text-red-500 font-semibold text-sm hover:bg-red-100 transition">
                        <span class="material-icons-round text-[18px]">delete</span>
                        Hapus Expo
                    </button>
                </form>
            </div>

        </div>

        <!-- KANAN: Proyek -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Tambah Proyek (hanya saat draft) -->
            @if($expo->status == 'draft')
                <div class="bg-white rounded-[24px] shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide">Tambah Proyek</h4>
                        <span class="text-xs text-[#A3AED0]">{{ $proyekTersedia->count() }} tersedia</span>
                    </div>

                    @if($proyekTersedia->isEmpty())
                        <div class="flex items-center gap-3 p-4 rounded-2xl bg-[#F4F7FE] text-[#A3AED0]">
                            <span class="material-icons-round text-[20px]">check_circle</span>
                            <p class="text-sm">Semua proyek terverifikasi sudah ditambahkan.</p>
                        </div>
                    @else
                        <form method="POST" action="{{ route('admin.expo.tambahProyek', $expo->id) }}" id="formTambahProyek">
                            @csrf

                            <!-- Filter row -->
                            <div class="flex flex-wrap gap-2 mb-3">
                                <!-- Search -->
                                <div class="flex items-center gap-2 bg-[#F4F7FE] rounded-xl px-3 py-2 flex-1 min-w-[160px]">
                                    <span class="material-icons-round text-[#A3AED0] text-[18px]">search</span>
                                    <input type="text" id="searchProyek" placeholder="Cari proyek..."
                                        class="bg-transparent text-sm text-[#1B2559] outline-none w-full placeholder-[#A3AED0]">
                                </div>

                                <!-- Filter Tahun -->
                                <select id="filterTahun"
                                    class="bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-3 py-2 outline-none">
                                    <option value="">Semua Tahun</option>
                                    @foreach($tahunList as $tahun)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                                </select>

                                <!-- Filter Dosen -->
                                <select id="filterDosen"
                                    class="bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-3 py-2 outline-none">
                                    <option value="">Semua Dosen</option>
                                    @foreach($dosenList as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Checklist proyek -->
                            <div id="listProyek" class="space-y-2 max-h-64 overflow-y-auto mb-4 pr-1">
                                @foreach($proyekTersedia as $p)
                                    <label class="proyek-item flex items-center gap-3 p-3 rounded-xl hover:bg-[#F4F7FE] cursor-pointer transition"
                                        data-nama="{{ strtolower($p->judul) }}"
                                        data-tahun="{{ $p->created_at->format('Y') }}"
                                        data-dosen="{{ $p->dosenId }}">
                                        <input type="checkbox" name="proyek_ids[]" value="{{ $p->id }}"
                                            class="w-4 h-4 accent-[#4318FF] rounded">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-[#1B2559] truncate">{{ $p->judul }}</p>
                                            <p class="text-xs text-[#A3AED0]">
                                                {{ $p->repoCode }} ·
                                                {{ $p->dosen?->nama ?? 'Tanpa dosen' }} ·
                                                {{ $p->created_at->format('Y') }}
                                            </p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <!-- Footer -->
                            <div class="flex items-center justify-between pt-2 border-t border-[#F4F7FE]">
                                <div class="flex items-center gap-3">
                                    <p id="selectedCount" class="text-xs text-[#A3AED0]">0 proyek dipilih</p>
                                    <button type="button" id="btnPilihSemua"
                                        class="text-xs text-[color:var(--primary)] hover:underline">
                                        Pilih semua
                                    </button>
                                </div>
                                <button type="submit" id="btnTambah" disabled
                                    class="flex items-center gap-1 px-4 py-2 bg-[color:var(--primary)] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition disabled:opacity-40 disabled:cursor-not-allowed">
                                    <span class="material-icons-round text-[16px]">add</span>
                                    Tambah ke Expo
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            @endif

            <!-- Daftar Proyek di Expo -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#A3AED0] uppercase tracking-wide mb-4">
                    Proyek di Expo ({{ $expo->proyeks->count() }})
                </h4>

                @if($expo->proyeks->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-[#A3AED0]">
                        <span class="material-icons-round text-5xl mb-3">folder_off</span>
                        <p class="text-sm">Belum ada proyek di expo ini</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($expo->proyeks as $proyek)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-[#F4F7FE]">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white text-[color:var(--primary)]">
                                        <span class="material-icons-round text-[18px]">rocket_launch</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1B2559]">{{ $proyek->judul }}</p>
                                        <p class="text-xs text-[#A3AED0]">
                                            {{ $proyek->kelompok->count() }} anggota ·
                                            {{ $proyek->repoCode }}
                                        </p>
                                    </div>
                                </div>

                                @if($expo->status == 'draft')
                                    <form method="POST"
                                        action="{{ route('admin.expo.hapusProyek', [$expo->id, $proyek->id]) }}"
                                        onsubmit="return confirm('Hapus proyek dari expo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center justify-center w-8 h-8 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition">
                                            <span class="material-icons-round text-[16px]">close</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script>
        function filterProyek() {
            const q     = (document.getElementById('searchProyek')?.value ?? '').toLowerCase();
            const tahun = document.getElementById('filterTahun')?.value ?? '';
            const dosen = document.getElementById('filterDosen')?.value ?? '';

            document.querySelectorAll('.proyek-item').forEach(el => {
                const matchNama  = el.dataset.nama.includes(q);
                const matchTahun = tahun === '' || el.dataset.tahun === tahun;
                const matchDosen = dosen === '' || el.dataset.dosen === dosen;
                el.style.display = (matchNama && matchTahun && matchDosen) ? '' : 'none';
            });
        }

        document.getElementById('searchProyek')?.addEventListener('input', filterProyek);
        document.getElementById('filterTahun')?.addEventListener('change', filterProyek);
        document.getElementById('filterDosen')?.addEventListener('change', filterProyek);

        function updateCount() {
            const checked = document.querySelectorAll('input[name="proyek_ids[]"]:checked').length;
            document.getElementById('selectedCount').textContent = checked + ' proyek dipilih';
            document.getElementById('btnTambah').disabled = checked === 0;
        }

        document.querySelectorAll('input[name="proyek_ids[]"]').forEach(cb => {
            cb.addEventListener('change', updateCount);
        });

        document.getElementById('btnPilihSemua')?.addEventListener('click', function () {
            const visibleCbs = [...document.querySelectorAll('.proyek-item')]
                .filter(el => el.style.display !== 'none')
                .map(el => el.querySelector('input[type="checkbox"]'));

            const allChecked = visibleCbs.every(cb => cb.checked);
            visibleCbs.forEach(cb => cb.checked = !allChecked);
            this.textContent = allChecked ? 'Pilih semua' : 'Hapus pilihan';
            updateCount();
        });
    </script>

@endsection