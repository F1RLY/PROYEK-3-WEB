<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;
use App\Models\mahasiswa;
use App\Models\proyek;
use App\Models\kelompok;
use App\Models\gambarProyek;
use App\Models\dosen;
use App\Models\users;
use App\Models\sosialMediaMahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\proyekController;


class pageController extends Controller
{
    public function home()
    {
        if(session("user-role") === "admin"){
            Auth::logout();
        }

        $topProjects = \App\Models\proyek::with('gambars')
                        ->where('verifikasi', 1)
                        ->latest()
                        ->take(3)
                        ->get();

        $allProjects = \App\Models\proyek::with(['gambars', 'kelompok'])
                        ->latest()
                        ->take(6)
                        ->get();

        $page = "home";
        return view("layouts/main", compact("page", "topProjects", "allProjects"));
    }

    public function expo()
    {
        if(session("user-role") === "admin"){
            Auth::logout();
            return redirect('/login');
        }

        $proyekList =proyek::all(); 

        $page = "expo";
        return view("layouts/main", compact("page", "proyekList"));
    }
        
    public function repository(Request $request)
    {
        $query = \App\Models\proyek::query();

        // Fitur Pencarian
        if ($request->has('q')) {
            $keyword = $request->q;
            $query->where('judul', 'LIKE', "%$keyword%")
                ->orWhere('deskripsi', 'LIKE', "%$keyword%");
        }

        // Fitur Filter Tahun
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('created_at', $request->year);
        }

        $allProjects = $query->latest()->get();
        $page = "repository";

        return view('layouts.main', compact('allProjects', 'page'));
    }

    // INI ku debug FIRLY
    public function repositoryDetail($code)
    {
        // 1. Jika admin sedang login, keluarkan dulu (sesuai logikamu sebelumnya)
        if(session("user-role") === "admin"){
            Auth::logout();
        }

        // 2. Ambil data proyek berdasarkan kode (repoCode)
        $proyek = ProyekController::getProyekByCode($code);

        // 3. Jika proyek tidak ada di database, tampilkan 404
        if (!$proyek) {
            abort(404, 'Proyek tidak ditemukan');
        }

        // 4. Ambil data Dosen pembimbing
        $dosenData = users::where('id', (string)$proyek['dosenId'])->first();
        $dosen = $dosenData ? $dosenData->username : 'Tidak ada dosen';

        // 5. Ambil data Mahasiswa (Anggota Kelompok)
        $mahasiswa = array();
        if (isset($proyek['mahasiswa']) && is_array($proyek['mahasiswa'])) {
            foreach($proyek['mahasiswa'] as $mhs){
                if (isset($mhs['nim'])) {
                    $mhsData = mahasiswaController::getMahasiswaByNim($mhs['nim']);
                    if ($mhsData) {
                        array_push($mahasiswa, $mhsData);
                    }
                }
            }
        }

        // 6. LOGIKA PENTING: Cek apakah ini proyek milik user yang sedang login
        // Kita buat defaultnya false
        $isMyProyek = false;
        
        // Hanya jalankan pengecekan jika ada user yang login (Auth::check)
        if (Auth::check()) {
            $isMyProyek = ProyekController::isMyProyek($code);
        }

        // 7. Data pendukung lainnya
        $prevPage = self::backToPrevpage();
        $repoCode = $code;
        $page = "detailRepository";

        // 8. Kirim semua data ke View
        return view("layouts/main", compact(
            "page", 
            'repoCode', 
            "prevPage", 
            "proyek", 
            "dosen", 
            'mahasiswa', 
            'isMyProyek'
        ));
    }
    // INI PUNYA KU CIP --FIRLY--

    public function repositoryEdit($code)
    {
        if(session("user-role") === "admin"){
            Auth::logout();
        }
        if( !proyekController::isMyProyek($code)){
            abort(404);
        }


        $dosenList = DosenController::getFewDosen();
        $mahasiswaList = mahasiswaController::getFewMahasiswa();

        $proyek = ProyekController::getProyekByCode($code);
        $dosen = DosenController::getDosenById($proyek['dosenId']);
        $mahasiswa = array();

        $prevPage = self::backToPrevpage();
        $page = "editRepository";
        return view("layouts/main", compact("page", "prevPage", "proyek", 'dosen', "dosenList", 'mahasiswaList', 'mahasiswa'));// ku tambahin ngirim dosen

    }

    public function userProfile($nim)
    {
        if(session("user-role") === "admin"){
            Auth::logout();
        }
        $mahasiswa = mahasiswaController::getMahasiswaByNim($nim);
        $prevPage = self::backToPrevpage();
        $proyek = ProyekController::getProyekById(1);
        $page = "userProfile";
        return view("layouts/main", compact("page", "proyek", "prevPage", "mahasiswa"));
    }

    public function about()
    {
        if(session("user-role") === "admin"){
            Auth::logout();
        }
        $page = "about";
        return view("layouts/main", compact("page"));
    }
    public function contact()
    {
        if(session("user-role") === "admin"){
            Auth::logout();
        }
        $page = "contact";
        return view("layouts/main", compact("page"));
    }

    public function project()
    {
        if(session("user-role") === "admin"){
            Auth::logout();
        }
        $page = "project";
        return view("layouts/main", compact("page"));
    }
    public function login()
    {
        $page = "login";
        return view("page/login", compact("page"));
    }
        
    public function profile()
    {
        if(session("user-role") === "admin"){
            Auth::logout();
        }
        
        $user = Auth::user();
        $prevPage = self::backToPrevpage();

        $nim = session('account')['nim'];
        $dataMhs = mahasiswaController::getMahasiswaByNim($nim);

        // echo count($dataMhs);

        $page = "profile";
        return view("layouts/main", compact("page", 'dataMhs', "prevPage", "user"));
    }

    //INI PUNYA KU CIP --FIRLY--
    public function profileEdit($nim)
    {
        $user = \Auth::user();
        $page = "profileEdit";

        // Ambil data mhs (Gunakan huruf kapital 'Mahasiswa' jika itu nama file modelnya)
        $mhs = \App\Models\mahasiswa::where('userID', $user->id)->first();

        $currentSocials = [];
        if ($mhs) {
            $currentSocials = \App\Models\sosialMediaMahasiswa::where('mahasiswa_id', $mhs->id)
                ->pluck('link', 'sosial_media_id')
                ->toArray();
        }

        return view("layouts/main", compact("page", "user", "mhs", "currentSocials"));
    }

    public function repositoryAdd(){
        if(session("user-role")=== "admin"){
            Auth::logout();
        }

        $user = Auth::user();
        $prevPage = self::backToPrevpage();
        $page = "addRepository";
        $dosen = DosenController::getFewDosen();
        $mahasiswa = mahasiswaController::getFewMahasiswa();
        return view("layouts/main", compact("prevPage", "page", "dosen", "mahasiswa"));
    }

    public function dosenProfile($nip){
        if(session("user-role")=="admin"){
            Auth::logout();
        }

        $dosen = dosen::where('NIP',$nip)->firstorfail();
        $prevPage = self::backToPrevpage();
        $page = "dosenProfile";

        return view("layouts/main",compact("page","prevPage","dosen"));
    }

    public function backToPrevpage(){
        $prevPage = back()->getTargetUrl();
        return $prevPage;
    }

 public function profileUpdate(Request $request)
{
    // 1. Ambil data User yang login (untuk update foto)
    $user = \App\Models\User::find(\Auth::user()->id);

    // 2. LOGIKA UPLOAD FOTO (Simpan di Tabel Users)
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        
        // Validasi file (Opsional tapi disarankan)
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Buat nama file unik
        $nama_file = "user_" . $user->id . "_" . time() . "." . $file->getClientOriginalExtension();
        
        // Pindahkan file ke public/image
        $file->move(public_path('image'), $nama_file);

        // Hapus foto lama jika ada dan bukan foto default
        if ($user->foto && file_exists(public_path('image/' . $user->foto))) {
            unlink(public_path('image/' . $user->foto));
        }

        // Simpan nama file baru ke kolom 'foto' di tabel 'users'
        $user->foto = $nama_file;
        $user->save();
    }

    // 3. LOGIKA UPDATE MEDIA SOSIAL (Simpan di Tabel Mahasiswa Sosial Media)
    // Cari data mahasiswa berdasarkan userID
    $mhs = \App\Models\mahasiswa::where('userID', $user->id)->first();

    if ($mhs && $request->has('socials')) {
        foreach ($request->socials as $id_medsos => $link) {
            if (!empty($link)) {
                // Jika input ada isinya, simpan atau update
                \App\Models\sosialMediaMahasiswa::updateOrCreate(
                    [
                        'mahasiswa_id' => $mhs->id, 
                        'sosial_media_id' => $id_medsos
                    ],
                    ['link' => $link]
                );
            } else {
                // Jika input kosong, hapus data medsos tersebut dari database
                \App\Models\SosialMediaMahasiswa::where('mahasiswa_id', $mhs->id)
                    ->where('sosial_media_id', $id_medsos)
                    ->delete();
            }
        }
    }

    // 4. Kembali ke halaman dengan pesan sukses
    return redirect()->back()->with('success', 'Profil, Foto, dan Media Sosial Anda berhasil diperbarui!');
}

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed', // 'confirmed' butuh input 'new_password_confirmation'
        ]);

        $user = Auth::user();

        // Cek apakah password saat ini cocok dengan di database
        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah!');
        }

        // Update password baru (di-hash)
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}
