@extends('admin.admin', ['title' => 'User'])

@section('content')

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-xl font-bold text-[#1B2559]">Manajemen User</h3>
            <p class="text-sm text-[#A3AED0]">Total {{ $users->total() }} user terdaftar</p>
        </div>
    </div>

    <!-- FILTER -->
    <form method="GET" action="{{ route('admin.user') }}" class="flex gap-3 mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari nama atau email..."
            class="flex-1 px-4 py-2 rounded-xl bg-white shadow-sm text-sm border-0 focus:ring-2 focus:ring-[color:var(--primary)] outline-none">

        <select name="role"
            class="px-4 py-2 rounded-xl bg-white shadow-sm text-sm border-0 focus:ring-2 focus:ring-[color:var(--primary)] outline-none">
            <option value="">Semua Role</option>
            <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="dosen" {{ request('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
        </select>

        <button type="submit"
            class="px-5 py-2 rounded-xl bg-[color:var(--primary)] text-white text-sm font-semibold hover:opacity-90 transition">
            Cari
        </button>

        @if(request('search') || request('role'))
            <a href="{{ route('admin.user') }}"
                class="px-5 py-2 rounded-xl bg-[#F4F7FE] text-[#A3AED0] text-sm font-semibold hover:text-[#1B2559] transition">
                Reset
            </a>
        @endif
    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-[24px] shadow-sm overflow-hidden">
        @if($users->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-[#A3AED0]">
                <span class="material-icons-round text-6xl mb-3">people_off</span>
                <p class="font-medium">Tidak ada user ditemukan</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#F4F7FE]">
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">No</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">User</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Email</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">NIM/Kode</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Role</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Bergabung</th>
                        <th class="text-left px-6 py-4 text-[#A3AED0] font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F4F7FE]">
                    @foreach($users as $i => $user)
                        <tr class="hover:bg-[#F4F7FE]/50 transition">

                            <td class="px-6 py-4 text-[#A3AED0]">{{ $users->firstItem() + $i }}</td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($user->foto)
                                        <img src="{{ asset('image/' . $user->foto) }}"
                                            class="w-9 h-9 rounded-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-[color:var(--primary)] text-white text-sm font-bold">
                                            {{ strtoupper(substr($user->username, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-semibold text-[#1B2559]">{{ $user->username }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-[#A3AED0]">{{ $user->email }}</td>

                            <td class="px-6 py-4 text-[#1B2559]">{{ $user->kode ?? '-' }}</td>

                            <td class="px-6 py-4">
                                @php
                                    $roleColor = match($user->role) {
                                        'admin'     => 'bg-purple-100 text-purple-600',
                                        'dosen'     => 'bg-blue-100 text-blue-600',
                                        default     => 'bg-[#F4F7FE] text-[#1B2559]',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $roleColor }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-[#A3AED0]">
                                {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ route('admin.user.detail', $user->id) }}"
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-xl bg-[#F4F7FE] text-[#1B2559] text-xs font-semibold hover:bg-[color:var(--primary)] hover:text-white transition w-fit">
                                    <span class="material-icons-round text-[14px]">visibility</span>
                                    Detail
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- PAGINATION -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-[#F4F7FE]">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>

@endsection