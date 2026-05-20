@extends('admin.admin', ['title' => 'Buat Expo'])

@section('content')

    <!-- BACK -->
    <a href="{{ route('admin.expo') }}"
        class="inline-flex items-center gap-2 text-sm text-[#A3AED0] hover:text-[#1B2559] mb-6 transition">
        <span class="material-icons-round text-[18px]">arrow_back</span>
        Kembali ke Expo
    </a>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-[24px] shadow-sm p-8">

            <h3 class="text-lg font-bold text-[#1B2559] mb-6">Buat Expo Baru</h3>

            @if($errors->any())
                <div class="mb-6 px-5 py-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.expo.store') }}" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold text-[#1B2559] mb-2">Nama Expo</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        placeholder="contoh: Expo TA 2026"
                        class="w-full px-4 py-3 rounded-xl bg-[#F4F7FE] text-sm text-[#1B2559] outline-none focus:ring-2 focus:ring-[color:var(--primary)]">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-[#1B2559] mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        placeholder="Deskripsi singkat tentang expo ini..."
                        class="w-full px-4 py-3 rounded-xl bg-[#F4F7FE] text-sm text-[#1B2559] outline-none focus:ring-2 focus:ring-[color:var(--primary)] resize-none">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Tanggal -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-[#1B2559] mb-2">Tanggal Mulai</label>
                        <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai"
                            value="{{ old('tanggal_mulai') }}"
                            class="w-full px-4 py-3 rounded-xl bg-[#F4F7FE] text-sm text-[#1B2559] outline-none focus:ring-2 focus:ring-[color:var(--primary)]">
                        <p class="text-xs text-[#A3AED0] mt-1">Tidak bisa pilih tanggal yang sudah lewat</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-[#1B2559] mb-2">Tanggal Selesai</label>
                        <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai"
                            value="{{ old('tanggal_selesai') }}"
                            class="w-full px-4 py-3 rounded-xl bg-[#F4F7FE] text-sm text-[#1B2559] outline-none focus:ring-2 focus:ring-[color:var(--primary)]">
                        <p class="text-xs text-[#A3AED0] mt-1">Harus setelah tanggal mulai</p>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 py-3 bg-[color:var(--primary)] text-white font-semibold text-sm rounded-xl hover:opacity-90 transition">
                        Buat Expo
                    </button>
                    <a href="{{ route('admin.expo') }}"
                        class="flex-1 py-3 bg-[#F4F7FE] text-[#A3AED0] font-semibold text-sm rounded-xl hover:text-[#1B2559] transition text-center">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script>
        // Set min tanggal mulai = sekarang
        const now = new Date();
        const pad = n => String(n).padStart(2, '0');
        const nowStr = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`;

        const mulai   = document.getElementById('tanggal_mulai');
        const selesai = document.getElementById('tanggal_selesai');

        mulai.min = nowStr;

        // Saat tanggal mulai berubah, update min tanggal selesai
        mulai.addEventListener('change', function () {
            selesai.min = this.value;
            if (selesai.value && selesai.value <= this.value) {
                selesai.value = '';
            }
        });

        // Inisialisasi min selesai jika sudah ada nilai
        if (mulai.value) selesai.min = mulai.value;
    </script>

@endsection