<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expo;
use App\Models\ExpoProyek;
use App\Models\Proyek;
use App\Models\Penilaian;

class ExpoController extends Controller
{
    // List semua expo
    public function index()
    {
        $expos = Expo::withCount('proyeks')
            ->latest()
            ->paginate(10);

        return view('admin.expo', compact('expos'));
    }

    // Form buat expo baru
    public function create()
    {
        return view('admin.expo-create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'tanggal_mulai'   => 'required|date|after_or_equal:now',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ], [
            'tanggal_mulai.after_or_equal' => 'Tanggal mulai tidak boleh tanggal yang sudah lewat.',
            'tanggal_selesai.after'        => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        Expo::create([
            'nama'            => $request->nama,
            'deskripsi'       => $request->deskripsi,
            'status'          => 'draft',
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.expo')->with('success', 'Expo berhasil dibuat!');
    }


    public function show($id)
    {
        $expo = Expo::with(['proyeks.gambars', 'proyeks.kelompok'])
            ->findOrFail($id);

        $proyekTersedia = Proyek::with('dosen')
            ->where('verifikasi', 1)
            ->whereNotIn('id', $expo->proyeks->pluck('id'))
            ->latest()
            ->get();

        $tahunList = $proyekTersedia->map(fn($p) => $p->created_at->format('Y'))
            ->unique()->sortDesc()->values();

        $dosenList = \App\Models\Dosen::orderBy('nama')->get();

        return view('admin.expo-detail', compact('expo', 'proyekTersedia', 'tahunList', 'dosenList'));
    }
    public function tambahProyek(Request $request, $id)
    {
        $request->validate([
            'proyek_ids'   => 'required|array|min:1',
            'proyek_ids.*' => 'exists:proyek,id',
        ]);

        $ditambahkan = 0;
        foreach ($request->proyek_ids as $proyekId) {
            $sudahAda = ExpoProyek::where('expo_id', $id)
                ->where('proyek_id', $proyekId)
                ->exists();

            if (!$sudahAda) {
                ExpoProyek::create([
                    'expo_id'    => $id,
                    'proyek_id'  => $proyekId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $ditambahkan++;
            }
        }

        return back()->with('success', $ditambahkan . ' proyek berhasil ditambahkan ke expo!');
    }

    // Hapus proyek dari expo
    public function hapusProyek($expoId, $proyekId)
    {
        ExpoProyek::where('expo_id', $expoId)
            ->where('proyek_id', $proyekId)
            ->delete();

        return back()->with('success', 'Proyek berhasil dihapus dari expo!');
    }

    // Start expo
    public function start($id)
    {
        $expo = Expo::findOrFail($id);

        if ($expo->proyeks->count() == 0) {
            return back()->with('error', 'Tambahkan minimal 1 proyek sebelum memulai expo!');
        }

        $expo->update(['status' => 'active']);

        return back()->with('success', 'Expo berhasil dimulai!');
    }

    // Stop expo
    public function stop($id)
    {
        Expo::findOrFail($id)->update(['status' => 'ended']);
        return back()->with('success', 'Expo berhasil dihentikan!');
    }

    // Hapus expo
    public function destroy($id)
    {
        Expo::findOrFail($id)->delete();
        return redirect()->route('admin.expo')->with('success', 'Expo berhasil dihapus!');
    }

    public function hasil($id)
    {
        $expo = \App\Models\Expo::with('proyeks')->findOrFail($id);

        // Ranking proyek berdasarkan rata-rata nilai
        $ranking = \App\Models\Penilaian::selectRaw('
                proyek_id,
                AVG(nilai) as rata_rata,
                COUNT(*) as jumlah_penilai
            ')
            ->where('expo_id', $expo->id)
            ->groupBy('proyek_id')
            ->orderByDesc('rata_rata')
            ->get()
            ->map(function ($item) {
                $item->judul = \App\Models\Proyek::find($item->proyek_id)?->judul ?? '-';
                return $item;
            });

        // Semua penilaian detail
        $penilaians = \App\Models\Penilaian::with('proyek')
            ->where('expo_id', $expo->id)
            ->latest()
            ->get();

        // Total penilaian & rata-rata keseluruhan
        $totalPenilaian = $penilaians->count();
        $rataRataTotal  = $totalPenilaian > 0
            ? number_format($penilaians->avg('nilai'), 1)
            : '-';

        // Distribusi nilai (1-10)
        $distribusiNilai = collect(range(1, 10))->mapWithKeys(function ($n) use ($expo) {
            return [$n => \App\Models\Penilaian::where('expo_id', $expo->id)
                ->where('nilai', $n)->count()];
        })->filter(fn($v) => $v > 0);

        return view('admin.expo-hasil', compact(
            'expo',
            'ranking',
            'penilaians',
            'totalPenilaian',
            'rataRataTotal',
            'distribusiNilai'
        ));
    }
}