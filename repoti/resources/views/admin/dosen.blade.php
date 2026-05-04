@extends('admin.admin', ['title' => 'Dosen'])

@section('content')

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-[#1B2559]">Manajemen Dosen</h3>
    </div>


    <!-- FORM TAMBAH DOSEN -->
    <div class="bg-white p-6 rounded-[24px] shadow-sm mb-8">

        <h4 class="text-lg font-semibold mb-4 text-[#1B2559]">
            Tambah Dosen
        </h4>

        <form class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Nama Dosen -->
            <div>
                <label class="text-sm font-medium">Nama Dosen</label>
                <input type="text"
                    name="nama"
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[color:var(--primary)] outline-none"
                    placeholder="Masukkan nama dosen">
            </div>

            <!-- Status Dospem -->
            <div>
                <label class="text-sm font-medium">Status</label>
                <select
                    name="status"
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[color:var(--primary)] outline-none">
                    
                    <option value="dospem">Dosen Pembimbing</option>
                    <option value="biasa">Dosen Biasa</option>
                </select>
            </div>

            <!-- Button -->
            <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-[color:var(--primary)] text-white font-semibold hover:bg-[color:var(--primary-dark)] transition">
                    Simpan
                </button>
            </div>

        </form>
    </div>


    <!-- TABLE DOSEN -->
    <div class="bg-white p-6 rounded-[24px] shadow-sm">

        <h4 class="text-lg font-semibold mb-4 text-[#1B2559]">
            Daftar Dosen
        </h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead>
                    <tr class="text-left text-[#A3AED0] border-b">
                        <th class="py-3">No</th>
                        <th>Nama Dosen</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                    @for ($i = 1; $i <= 5; $i++)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="py-3">{{ $i }}</td>

                            <!-- Nama -->
                            <td class="font-semibold text-[#1B2559]">
                                Dosen {{ $i }}
                            </td>

                            <!-- Status -->
                            <td>
                                @if ($i % 2 == 0)
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                        Dospem
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-500">
                                        Biasa
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="text-right">
                                <button class="text-gray-400 cursor-not-allowed text-sm">
                                    Edit
                                </button>
                                <button class="text-gray-300 cursor-not-allowed text-sm ml-3">
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