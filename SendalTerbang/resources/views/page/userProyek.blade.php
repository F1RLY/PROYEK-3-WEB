<section class="project-section">
    <div class="header">
        <h2>Proyek Kamu</h2>
        <a href="" class="btn-add"  style="text-decoration: none">+ Tambah Proyek</a>
        {{-- {{ route('proyek.create') }} --}}
    </div>

    <div class="table-wrapper">
        <table class="project-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Proyek</th>
                    <th>Nama Anggota</th>
                    <th>Dosen Pembimbing</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($proyek as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->judul_proyek }}</td>
                    <td>{{ $p->nama_anggota }}</td>
                    <td>{{ $p->dosen_pembimbing }}</td>
                    <td>{{ $p->tahun_penerbit }}</td>

                    <td>
                        <span class="status 
                            {{ strtolower($p->status) }}">
                            {{ $p->status }}
                        </span>
                    </td>

                    <td class="actions">
                        <a href="{{ route('proyek.edit', $p->id) }}" class="btn-edit">Edit</a>

                        <form action="{{ route('proyek.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" style="text-align:center; height: 250px;">
                        Belum ada proyek yang kamu upload.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
