@extends('admin.admin', ['title' => 'Expo'])

@section('content')

    <!-- HEADER ACTION -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-[#1B2559]">Manajemen Expo</h3>
    </div>


    <!-- FORM TAMBAH PROYEK EXPO -->
    <div class="bg-white p-6 rounded-[24px] shadow-sm mb-8">

        <h4 class="text-lg font-semibold mb-4 text-[#1B2559]">
            Tambah Proyek ke Expo
        </h4>

        <form class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Nama Proyek -->
            <div>
                <label class="text-sm font-medium text-[#1B2559]">Nama Proyek</label>
                <input type="text"
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[color:var(--primary)]"
                    placeholder="Masukkan nama proyek">
            </div>

            <!-- Nama Tim -->
            <div>
                <label class="text-sm font-medium text-[#1B2559]">Kelas</label>
                <input type="text"
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[color:var(--primary)]"
                    placeholder="Masukkan nama kelas">
            </div>

            <!-- Nomor Meja -->
            <div>
                <label class="text-sm font-medium text-[#1B2559]">Nomor Meja</label>
                <input type="number"
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[color:var(--primary)]"
                    placeholder="Contoh: 12">
            </div>

            <!-- Status -->
            <div>
                <label class="text-sm font-medium text-[#1B2559]">Status</label>
                <select
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[color:var(--primary)]">
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                </select>
            </div>

            <!-- Button -->
            <div class="md:col-span-2 flex justify-end mt-2">
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-[color:var(--primary)] text-white font-semibold hover:bg-[color:var(--primary-dark)] transition">
                    Simpan
                </button>
            </div>

        </form>
    </div>


    <!-- TABLE DATA EXPO -->
    <div class="bg-white p-6 rounded-[24px] shadow-sm">

        <h4 class="text-lg font-semibold mb-4 text-[#1B2559]">
            Daftar Proyek Expo
        </h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead>
                    <tr class="text-left text-[#A3AED0] border-b">
                        <th class="py-3">No</th>
                        <th>Nama Proyek</th>
                        <th>Tim</th>
                        <th>Meja</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                    @for ($i = 1; $i <= 5; $i++)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="py-3">{{ $i }}</td>
                            <td class="font-semibold text-[#1B2559]">Project {{ $i }}</td>
                            <td>Tim {{ $i }}</td>
                            <td>
                                <span class="px-3 py-1 bg-[#F4F7FE] rounded-lg">
                                    {{ rand(1,20) }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td>
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                    Aktif
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="text-right">
                                <button class="text-[color:var(--primary)] hover:underline text-sm">
                                    Edit
                                </button>
                                <button class="text-red-500 ml-3 hover:underline text-sm">
                                    Hapus
                                </button>
                            </td>

                        </tr>
                    @endfor
                </tbody>

            </table>
        </div>

    </div>

@endsection