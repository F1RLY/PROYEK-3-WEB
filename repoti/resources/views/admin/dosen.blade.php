@extends('admin.admin', ['title' => 'Dosen'])

@section('content')

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-[#1B2559]">Dosen Pembimbing</h2>
            <p class="text-sm text-[#A3AED0] mt-1">Kelola data dosen pembimbing proyek</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="flex items-center gap-2 px-4 py-2 bg-[color:var(--primary)] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition">
            <span class="material-icons-round text-[18px]">add</span>
            Tambah Dosen
        </button>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-4 px-5 py-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABEL --}}
    <div class="bg-white rounded-[24px] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#F4F7FE]">
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">#</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Nama</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">NIP</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Proyek</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F4F7FE]">
                    @forelse($dosens as $dosen)
                        <tr class="hover:bg-[#F4F7FE] transition">
                            <td class="px-6 py-4 text-[#A3AED0]">
                                {{ ($dosens->currentPage() - 1) * $dosens->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-50 text-[color:var(--primary)] font-bold text-sm shrink-0">
                                        {{ strtoupper(substr($dosen->nama, 0, 1)) }}
                                    </div>
                                    <p class="font-semibold text-[#1B2559]">{{ $dosen->nama }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#A3AED0]">{{ $dosen->NIP }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-[color:var(--primary)]">
                                    {{ $dosen->proyek()->count() }} proyek
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    {{-- Edit --}}
                                    <button
                                        onclick="openEditModal({{ $dosen->id }}, '{{ addslashes($dosen->nama) }}', '{{ addslashes($dosen->NIP) }}')"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-[#F4F7FE] text-[color:var(--primary)] text-xs font-semibold hover:bg-blue-50 transition">
                                        <span class="material-icons-round text-[14px]">edit</span>
                                        Edit
                                    </button>
                                    {{-- Hapus --}}
                                    <button onclick="openDeleteModal({{ $dosen->id }}, '{{ addslashes($dosen->nama) }}')"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-100 transition">
                                        <span class="material-icons-round text-[14px]">delete</span>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-2 text-[#A3AED0]">
                                    <span class="material-icons-round text-5xl">school</span>
                                    <p class="text-sm font-medium">Belum ada data dosen</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($dosens->hasPages())
            <div class="px-6 py-4 border-t border-[#F4F7FE] flex items-center justify-between">
                <p class="text-xs text-[#A3AED0]">
                    Menampilkan {{ $dosens->firstItem() }}–{{ $dosens->lastItem() }} dari {{ $dosens->total() }} dosen
                </p>
                <div class="flex items-center gap-1">
                    @if($dosens->onFirstPage())
                        <span class="px-3 py-1.5 rounded-xl text-xs text-[#A3AED0] bg-[#F4F7FE] cursor-not-allowed">
                            <span class="material-icons-round text-[14px]">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $dosens->previousPageUrl() }}"
                            class="px-3 py-1.5 rounded-xl text-xs text-[#1B2559] bg-[#F4F7FE] hover:bg-blue-50 transition">
                            <span class="material-icons-round text-[14px]">chevron_left</span>
                        </a>
                    @endif

                    @foreach($dosens->getUrlRange(1, $dosens->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold transition
                                {{ $page == $dosens->currentPage()
                                    ? 'bg-[color:var(--primary)] text-white'
                                    : 'text-[#1B2559] bg-[#F4F7FE] hover:bg-blue-50' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($dosens->hasMorePages())
                        <a href="{{ $dosens->nextPageUrl() }}"
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

    {{-- MODAL TAMBAH --}}
    <div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-[24px] shadow-xl w-full max-w-md mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-[#1B2559]">Tambah Dosen</h3>
                <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="text-[#A3AED0] hover:text-[#1B2559] transition">
                    <span class="material-icons-round">close</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.dosen.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-[#A3AED0] mb-1 block">Nama Dosen</label>
                        <input type="text" name="nama" required
                            placeholder="Masukkan nama dosen"
                            class="w-full bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[color:var(--primary)] placeholder-[#A3AED0]">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-[#A3AED0] mb-1 block">NIP</label>
                        <input type="text" name="NIP" required
                            placeholder="Masukkan NIP"
                            class="w-full bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[color:var(--primary)] placeholder-[#A3AED0]">
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button"
                        onclick="document.getElementById('modalTambah').classList.add('hidden')"
                        class="flex-1 py-3 rounded-xl bg-[#F4F7FE] text-[#A3AED0] text-sm font-semibold hover:text-[#1B2559] transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 rounded-xl bg-[color:var(--primary)] text-white text-sm font-semibold hover:opacity-90 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-[24px] shadow-xl w-full max-w-md mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-[#1B2559]">Edit Dosen</h3>
                <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="text-[#A3AED0] hover:text-[#1B2559] transition">
                    <span class="material-icons-round">close</span>
                </button>
            </div>
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-[#A3AED0] mb-1 block">Nama Dosen</label>
                        <input type="text" id="editNama" name="nama" required
                            class="w-full bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[color:var(--primary)]">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-[#A3AED0] mb-1 block">NIP</label>
                        <input type="text" id="editNIP" name="NIP" required
                            class="w-full bg-[#F4F7FE] text-sm text-[#1B2559] rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[color:var(--primary)]">
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button"
                        onclick="document.getElementById('modalEdit').classList.add('hidden')"
                        class="flex-1 py-3 rounded-xl bg-[#F4F7FE] text-[#A3AED0] text-sm font-semibold hover:text-[#1B2559] transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 rounded-xl bg-[color:var(--primary)] text-white text-sm font-semibold hover:opacity-90 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div id="modalHapus" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-[24px] shadow-xl w-full max-w-sm mx-4 p-6 text-center">
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-red-50 mx-auto mb-4">
                <span class="material-icons-round text-red-500 text-[28px]">delete</span>
            </div>
            <h3 class="text-lg font-bold text-[#1B2559] mb-2">Hapus Dosen?</h3>
            <p class="text-sm text-[#A3AED0] mb-6">
                Anda akan menghapus <span id="hapusNama" class="font-semibold text-[#1B2559]"></span>.
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button"
                        onclick="document.getElementById('modalHapus').classList.add('hidden')"
                        class="flex-1 py-3 rounded-xl bg-[#F4F7FE] text-[#A3AED0] text-sm font-semibold hover:text-[#1B2559] transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 rounded-xl bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, nama, nip) {
            document.getElementById('editNama').value = nama;
            document.getElementById('editNIP').value = nip;
            document.getElementById('formEdit').action = '/admin/dosen/' + id;
            document.getElementById('modalEdit').classList.remove('hidden');
        }

        function openDeleteModal(id, nama) {
            document.getElementById('hapusNama').textContent = nama;
            document.getElementById('formHapus').action = '/admin/dosen/' + id;
            document.getElementById('modalHapus').classList.remove('hidden');
        }

        // Tutup modal klik di luar
        ['modalTambah', 'modalEdit', 'modalHapus'].forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) this.classList.add('hidden');
            });
        });
    </script>

@endsection