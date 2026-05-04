@extends('admin.admin', ['title' => 'User'])

@section('content')

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-[#1B2559]">Manajemen User</h3>
    </div>


    <!-- TABLE USER -->
    <div class="bg-white p-6 rounded-[24px] shadow-sm">

        <h4 class="text-lg font-semibold mb-4 text-[#1B2559]">
            Daftar User
        </h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead>
                    <tr class="text-left text-[#A3AED0] border-b">
                        <th class="py-3">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                    @for ($i = 1; $i <= 5; $i++)
                        <tr class="border-b hover:bg-gray-50">

                            <!-- No -->
                            <td class="py-3">{{ $i }}</td>

                            <!-- Nama -->
                            <td class="font-semibold text-[#1B2559]">
                                User {{ $i }}
                            </td>

                            <!-- Email -->
                            <td class="text-gray-500">
                                user{{ $i }}@mail.com
                            </td>

                            <!-- Role -->
                            <td>
                                @if ($i == 1)
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-600">
                                        Admin
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-[#F4F7FE] text-[#1B2559]">
                                        User
                                    </span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td>
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                    Aktif
                                </span>
                            </td>

                            <!-- Last Login -->
                            <td class="text-gray-400 text-sm">
                                2 jam lalu
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