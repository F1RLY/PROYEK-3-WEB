@extends('admin.admin', ['title' => 'Hasil Expo'])

@section('content')

    <!-- BACK -->
    <a href="{{ route('admin.expo.show', $expo->id) }}"
        class="inline-flex items-center gap-2 text-sm text-[#A3AED0] hover:text-[#1B2559] mb-6 transition">
        <span class="material-icons-round text-[18px]">arrow_back</span>
        Kembali ke Detail Expo
    </a>

    <!-- HEADER -->
    <div class="bg-white rounded-[24px] shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 mb-2 inline-block">Selesai</span>
                <h2 class="text-xl font-bold text-[#1B2559]">{{ $expo->nama }}</h2>
                <p class="text-sm text-[#A3AED0] mt-1">{{ $expo->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <div class="text-right text-sm text-[#A3AED0]">
                <p>{{ \Carbon\Carbon::parse($expo->tanggal_mulai)->format('d M Y') }}</p>
                <p>— {{ \Carbon\Carbon::parse($expo->tanggal_selesai)->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-[20px] shadow-sm p-5 flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50">
                <span class="material-icons-round text-[color:var(--primary)] text-[22px]">rocket_launch</span>
            </div>
            <div>
                <p class="text-xs text-[#A3AED0]">Total Proyek</p>
                <p class="text-2xl font-bold text-[#1B2559]">{{ $expo->proyeks->count() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-[20px] shadow-sm p-5 flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-purple-50">
                <span class="material-icons-round text-purple-500 text-[22px]">how_to_vote</span>
            </div>
            <div>
                <p class="text-xs text-[#A3AED0]">Total Penilaian</p>
                <p class="text-2xl font-bold text-[#1B2559]">{{ $totalPenilaian }}</p>
            </div>
        </div>
        <div class="bg-white rounded-[20px] shadow-sm p-5 flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-yellow-50">
                <span class="material-icons-round text-yellow-500 text-[22px]">star</span>
            </div>
            <div>
                <p class="text-xs text-[#A3AED0]">Rata-rata Nilai</p>
                <p class="text-2xl font-bold text-[#1B2559]">{{ $rataRataTotal }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- RANKING PROYEK -->
        <div class="lg:col-span-2 bg-white rounded-[24px] shadow-sm p-6">
            <h3 class="text-base font-bold text-[#1B2559] mb-6">Peringkat Proyek</h3>

            @if($ranking->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-[#A3AED0]">
                    <span class="material-icons-round text-5xl mb-3">bar_chart</span>
                    <p class="text-sm">Belum ada penilaian</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($ranking as $i => $item)
                        @php
                            $rank = $i + 1;
                            $medalColor = match($rank) {
                                1 => 'text-yellow-400',
                                2 => 'text-gray-400',
                                3 => 'text-orange-400',
                                default => 'text-[#A3AED0]',
                            };
                            $bgColor = match($rank) {
                                1 => 'bg-yellow-50 border border-yellow-200',
                                2 => 'bg-gray-50 border border-gray-200',
                                3 => 'bg-orange-50 border border-orange-100',
                                default => 'bg-[#F4F7FE]',
                            };
                            $maxNilai = $ranking->first()->rata_rata ?? 1;
                            $persen = $maxNilai > 0 ? ($item->rata_rata / 10) * 100 : 0;
                        @endphp

                        <div class="p-4 rounded-2xl {{ $bgColor }}">
                            <div class="flex items-center gap-4">

                                <!-- Rank -->
                                <div class="shrink-0 w-10 text-center">
                                    @if($rank <= 3)
                                        <span class="material-icons-round text-[28px] {{ $medalColor }}">
                                            {{ $rank == 1 ? 'emoji_events' : 'military_tech' }}
                                        </span>
                                    @else
                                        <span class="text-lg font-bold text-[#A3AED0]">#{{ $rank }}</span>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="text-sm font-semibold text-[#1B2559] truncate">
                                            {{ $item->judul }}
                                        </p>
                                        <div class="flex items-center gap-1 shrink-0 ml-2">
                                            <span class="material-icons-round text-yellow-400 text-[16px]">star</span>
                                            <span class="text-sm font-bold text-[#1B2559]">
                                                {{ number_format($item->rata_rata, 1) }}
                                            </span>
                                            <span class="text-xs text-[#A3AED0]">/10</span>
                                        </div>
                                    </div>

                                    <!-- Progress bar -->
                                    <div class="w-full bg-white rounded-full h-2 mb-1">
                                        <div class="h-2 rounded-full transition-all"
                                            style="width: {{ $persen }}%;
                                                   background: {{ $rank == 1 ? '#F6C94E' : ($rank == 2 ? '#A3AED0' : ($rank == 3 ? '#F97316' : '#4318FF')) }}">
                                        </div>
                                    </div>

                                    <p class="text-xs text-[#A3AED0]">
                                        {{ $item->jumlah_penilai }} penilai
                                    </p>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- GRAFIK + PEMENANG -->
        <div class="space-y-6">

            <!-- Pemenang -->
            @if($ranking->isNotEmpty())
                <div class="bg-white rounded-[24px] shadow-sm p-6 text-center">
                    <span class="material-icons-round text-yellow-400 text-[48px]">emoji_events</span>
                    <p class="text-xs text-[#A3AED0] mt-2 mb-1">Proyek Terbaik</p>
                    <h4 class="text-base font-bold text-[#1B2559]">{{ $ranking->first()->judul }}</h4>
                    <div class="flex items-center justify-center gap-1 mt-2">
                        @for($s = 1; $s <= 10; $s++)
                            <span class="material-icons-round text-[14px] {{ $s <= round($ranking->first()->rata_rata) ? 'text-yellow-400' : 'text-gray-200' }}">
                                star
                            </span>
                        @endfor
                    </div>
                    <p class="text-2xl font-bold text-[#1B2559] mt-2">
                        {{ number_format($ranking->first()->rata_rata, 1) }}
                        <span class="text-sm font-normal text-[#A3AED0]">/10</span>
                    </p>
                </div>
            @endif

            <!-- Grafik distribusi nilai -->
            <div class="bg-white rounded-[24px] shadow-sm p-6">
                <h4 class="text-sm font-bold text-[#1B2559] mb-4">Distribusi Nilai</h4>
                <canvas id="chartDistribusi" height="200"></canvas>
            </div>

        </div>

    </div>

    <!-- TABEL DETAIL PENILAIAN -->
    <div class="bg-white rounded-[24px] shadow-sm p-6 mt-6">
        <h3 class="text-base font-bold text-[#1B2559] mb-6">Detail Semua Penilaian</h3>

        @if($penilaians->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-[#A3AED0]">
                <span class="material-icons-round text-5xl mb-3">how_to_vote</span>
                <p class="text-sm">Belum ada penilaian masuk</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-[#F4F7FE]">
                            <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">#</th>
                            <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Penilai</th>
                            <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Proyek</th>
                            <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Nilai</th>
                            <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F4F7FE]">
                        @foreach($penilaians as $p)
                            <tr class="hover:bg-[#F4F7FE] transition">
                                <td class="py-3 pr-4 text-[#A3AED0]">{{ $loop->iteration }}</td>
                                <td class="py-3 pr-4">
                                    <p class="font-semibold text-[#1B2559]">{{ $p->nama_penilai }}</p>
                                    <p class="text-xs text-[#A3AED0]">{{ $p->email_penilai }}</p>
                                </td>
                                <td class="py-3 pr-4 text-[#1B2559]">
                                    {{ $p->proyek?->judul ?? '-' }}
                                </td>
                                <td class="py-3 pr-4">
                                    <div class="flex items-center gap-1">
                                        <span class="material-icons-round text-yellow-400 text-[14px]">star</span>
                                        <span class="font-bold text-[#1B2559]">{{ $p->nilai }}</span>
                                        <span class="text-xs text-[#A3AED0]">/10</span>
                                    </div>
                                </td>
                                <td class="py-3 text-xs text-[#A3AED0]">
                                    {{ $p->created_at->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const distribusiData = @json($distribusiNilai);
        const labels = Object.keys(distribusiData).map(k => 'Nilai ' + k);
        const values = Object.values(distribusiData);

        new Chart(document.getElementById('chartDistribusi'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        '#4318FF','#6AD2FF','#F6C94E','#F97316','#22C55E',
                        '#A855F7','#EC4899','#14B8A6','#64748B','#EF4444'
                    ],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 10 }, color: '#A3AED0', boxWidth: 10 }
                    }
                }
            }
        });
    </script>

@endsection