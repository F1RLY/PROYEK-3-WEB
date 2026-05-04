@extends('admin.admin', ['title' => 'Dashboard'])

@section('content')

    <!-- STAT CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
            $stats = [
                ['label' => 'Total Expo', 'value' => '12', 'icon' => 'event'],
                ['label' => 'Proyek Aktif', 'value' => '48', 'icon' => 'rocket_launch'],
                ['label' => 'Total Dosen', 'value' => '25', 'icon' => 'school'],
                ['label' => 'User Reg', 'value' => '120', 'icon' => 'people'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="flex items-center gap-4 p-6 bg-white rounded-[24px] shadow-sm">

                <!-- Icon -->
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-[#F4F7FE] text-[color:var(--primary)]">
                    <span class="material-icons-round text-[28px]">
                        {{ $stat['icon'] }}
                    </span>
                </div>

                <!-- Text -->
                <div>
                    <p class="text-xs font-medium text-[#A3AED0]">
                        {{ $stat['label'] }}
                    </p>
                    <h3 class="text-2xl font-bold text-[#1B2559]">
                        {{ $stat['value'] }}
                    </h3>
                </div>

            </div>
        @endforeach
    </div>


    <!-- AKTIVITAS TERBARU -->
    <div class="p-8 bg-white rounded-[24px] shadow-sm">

        <!-- Title -->
        <h3 class="mb-6 text-lg font-bold text-[#1B2559]">
            Aktivitas Terbaru
        </h3>

        <!-- List -->
        <div class="space-y-6">
            @for ($i = 1; $i <= 3; $i++)
                <div class="flex items-center justify-between">

                    <!-- Left -->
                    <div class="flex items-center gap-4">

                        <!-- Number -->
                        <div class="flex items-center justify-center w-10 h-10 text-sm font-bold rounded-full bg-[#F4F7FE] text-[#1B2559]">
                            {{ $i }}
                        </div>

                        <!-- Skeleton -->
                        <div>
                            <div class="w-48 h-3 mb-2 rounded-full bg-[#F4F7FE]"></div>
                            <div class="w-32 h-2 rounded-full bg-[#F4F7FE]/60"></div>
                        </div>

                    </div>

                    <!-- Action -->
                    <button class="text-[#A3AED0] hover:text-[color:var(--primary)] transition">
                        <span class="material-icons-round">
                            more_vert
                        </span>
                    </button>

                </div>
            @endfor
        </div>

    </div>

@endsection