@extends('admin.admin', ['title' => 'Dashboard'])

@section('content')

    <!-- STAT CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="flex items-center gap-4 p-6 bg-white rounded-[24px] shadow-sm">
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-blue-50 text-[color:var(--primary)]">
                <span class="material-icons-round text-[28px]">rocket_launch</span>
            </div>
            <div>
                <p class="text-xs font-medium text-[#A3AED0]">Total Proyek</p>
                <h3 class="text-2xl font-bold text-[#1B2559]">{{ $totalProyek }}</h3>
            </div>
        </div>

        <div class="flex items-center gap-4 p-6 bg-white rounded-[24px] shadow-sm">
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-yellow-50 text-yellow-500">
                <span class="material-icons-round text-[28px]">hourglass_empty</span>
            </div>
            <div>
                <p class="text-xs font-medium text-[#A3AED0]">Menunggu Verifikasi</p>
                <h3 class="text-2xl font-bold text-[#1B2559]">{{ $menunggu }}</h3>
            </div>
        </div>

        <div class="flex items-center gap-4 p-6 bg-white rounded-[24px] shadow-sm">
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-green-50 text-green-500">
                <span class="material-icons-round text-[28px]">school</span>
            </div>
            <div>
                <p class="text-xs font-medium text-[#A3AED0]">Total Dosen</p>
                <h3 class="text-2xl font-bold text-[#1B2559]">{{ $totalDosen }}</h3>
            </div>
        </div>

        <div class="flex items-center gap-4 p-6 bg-white rounded-[24px] shadow-sm">
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-purple-50 text-purple-500">
                <span class="material-icons-round text-[28px]">people</span>
            </div>
            <div>
                <p class="text-xs font-medium text-[#A3AED0]">User Terdaftar</p>
                <h3 class="text-2xl font-bold text-[#1B2559]">{{ $totalMahasiswa }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- GRAFIK PROYEK PER BULAN -->
        <div class="lg:col-span-2 bg-white rounded-[24px] shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-bold text-[#1B2559]">Proyek per Bulan</h3>
                    <p class="text-xs text-[#A3AED0] mt-0.5">Tahun {{ now()->year }}</p>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#F4F7FE]">
                    <span class="w-2 h-2 rounded-full bg-[color:var(--primary)]"></span>
                    <span class="text-xs text-[#A3AED0]">Proyek diupload</span>
                </div>
            </div>
            <canvas id="chartProyek" height="100"></canvas>
        </div>

        <!-- PROYEK MENUNGGU VERIFIKASI -->
        <div class="bg-white rounded-[24px] shadow-sm p-6 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-[#1B2559]">Perlu Verifikasi</h3>
                <a href="{{ route('admin.verifikasi') }}"
                    class="text-xs font-semibold text-[color:var(--primary)] hover:underline">
                    Lihat semua
                </a>
            </div>

            @if($proyekMenunggu->isEmpty())
                <div class="flex-1 flex flex-col items-center justify-center text-[#A3AED0] py-8">
                    <span class="material-icons-round text-4xl mb-2">check_circle</span>
                    <p class="text-sm">Semua proyek sudah diverifikasi</p>
                </div>
            @else
                <div class="space-y-3 flex-1">
                    @foreach($proyekMenunggu as $proyek)
                        <a href="{{ route('admin.verifikasi.detail', $proyek->id) }}"
                            class="flex items-center gap-3 p-3 rounded-2xl hover:bg-[#F4F7FE] transition group">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-50 shrink-0">
                                <span class="material-icons-round text-yellow-500 text-[18px]">folder</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-[#1B2559] truncate group-hover:text-[color:var(--primary)] transition">
                                    {{ $proyek->judul }}
                                </p>
                                <p class="text-xs text-[#A3AED0]">
                                    {{ $proyek->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <span class="material-icons-round text-[#A3AED0] text-[18px]">chevron_right</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <!-- PROYEK TERBARU -->
    <div class="bg-white rounded-[24px] shadow-sm p-6 mt-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-bold text-[#1B2559]">Proyek Terbaru</h3>
            <a href="{{ route('admin.proyek') }}"
                class="text-xs font-semibold text-[color:var(--primary)] hover:underline">
                Lihat semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#F4F7FE]">
                        <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Proyek</th>
                        <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Dosen</th>
                        <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Tanggal</th>
                        <th class="text-left pb-3 text-xs font-bold text-[#A3AED0] uppercase tracking-wide">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F4F7FE]">
                    @forelse($proyekTerbaru as $proyek)
                        <tr class="hover:bg-[#F4F7FE] transition">
                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 shrink-0">
                                        <span class="material-icons-round text-[color:var(--primary)] text-[16px]">rocket_launch</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-[#1B2559] max-w-[200px] truncate">{{ $proyek->judul }}</p>
                                        <p class="text-xs text-[#A3AED0]">{{ $proyek->repoCode }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 pr-4 text-[#A3AED0] text-xs">{{ $proyek->dosen?->nama ?? '-' }}</td>
                            <td class="py-3 pr-4 text-[#A3AED0] text-xs">{{ $proyek->created_at->format('d M Y') }}</td>
                            <td class="py-3">
                                @if($proyek->verifikasi == 0)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">Menunggu</span>
                                @elseif($proyek->verifikasi == 1)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">Disetujui</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-[#A3AED0] text-sm">Belum ada proyek</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const bulanLabel = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const dataProyek = @json($proyekPerBulan);

        new Chart(document.getElementById('chartProyek'), {
            type: 'bar',
            data: {
                labels: bulanLabel,
                datasets: [{
                    label: 'Proyek',
                    data: dataProyek,
                    backgroundColor: 'rgba(67, 24, 255, 0.08)',
                    borderColor: '#4318FF',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.parsed.y} proyek`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, color: '#A3AED0', font: { size: 11 } },
                        grid: { color: '#F4F7FE' }
                    },
                    x: {
                        ticks: { color: '#A3AED0', font: { size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>

@endsection