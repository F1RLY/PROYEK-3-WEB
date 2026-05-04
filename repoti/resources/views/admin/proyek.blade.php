@extends('admin.admin', ['title' => 'Proyek'])

@section('content')

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-[#1B2559]">Manajemen Proyek</h3>
    </div>


    <!-- FORM INPUT PROYEK -->
    <div class="bg-white p-6 rounded-[24px] shadow-sm mb-8">

        <h4 class="text-lg font-semibold mb-4 text-[#1B2559]">
            Tambah Proyek
        </h4>

        <form class="grid grid-cols-1 md:grid-cols-2 gap-4" enctype="multipart/form-data">

            <!-- Nama Proyek-->
            <div class="md:col-span-2">
                <label class="text-sm font-medium">Nama Proyek</label>
                <input type="text"
                    name="nama_proyek"
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[color:var(--primary)] outline-none"
                    placeholder="Masukkan nama proyek">
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <label class="text-sm font-medium">Deskripsi</label>
                <textarea rows="3"
                    name="deskripsi"
                    class="w-full mt-1 px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[color:var(--primary)] outline-none"
                    placeholder="Deskripsi proyek..."></textarea>
            </div>

            <!-- Upload Section -->
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- PDF -->
                <div>
                    <label class="text-sm font-medium">Upload Proposal</label>
                    <input type="file"
                        name="pdf"
                        accept=".pdf"
                        class="w-full mt-1 text-sm">
                </div>

                <!-- PPT -->
                <div>
                    <label class="text-sm font-medium">Upload PPT</label>
                    <input type="file"
                        name="ppt"
                        accept=".ppt,.pptx"
                        class="w-full mt-1 text-sm">
                </div>

                <!-- Video -->
                <div>
                    <label class="text-sm font-medium">Upload Video</label>
                    <input type="file"
                        name="video"
                        accept="video/*"
                        class="w-full mt-1 text-sm">
                </div>

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


    <!-- LIST DATA PROYEK -->
    <div class="bg-white p-6 rounded-[24px] shadow-sm">

        <h4 class="text-lg font-semibold mb-4 text-[#1B2559]">
            Daftar Proyek
        </h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead>
                    <tr class="text-left text-[#A3AED0] border-b">
                        <th class="py-3">No</th>
                        <th>Nama Proyek</th>
                        <th>File</th>
                        <th>Video</th>
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
                                Project {{ $i }}
                            </td>

                            <!-- File -->
                            <td class="space-x-2">
                                <span class="text-xs bg-red-100 text-red-500 px-2 py-1 rounded">
                                    PDF
                                </span>
                                <span class="text-xs bg-yellow-100 text-yellow-600 px-2 py-1 rounded">
                                    PPT
                                </span>
                            </td>

                            <!-- Video -->
                            <td>
                                <a href="#" class="text-[color:var(--primary)] text-sm hover:underline">
                                    Lihat Video
                                </a>
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