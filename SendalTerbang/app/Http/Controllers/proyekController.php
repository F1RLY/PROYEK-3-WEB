<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proyek; 
use App\Models\kelompok;
use App\Models\gambar;
use App\Models\gambarProyek;
use Illuminate\Support\Str;
use App\Http\Controllers\proyekValidationController;
use App\Models\video;
use App\Models\users;
use App\Models\mahasiswa;
use App\Http\Controllers\videoController;

class ProyekController extends Controller
{
    public static function getProyekByKeyWord( string $keyword){
        $array = proyek::where("judul", "like", "%".(string)$keyword."%")->get();
        return $array;
    }

    public static function getProyekById( int $id ){
        $array = proyek::where("id", (string)$id)->get()->first();
        
        $Arr_img = gambarController::getAllProjectImageByProjectId($id);

        $Arr_group = kelompokController::getKelompokFromProyek($id);
        $img_location = array();

        $array["images"] = $Arr_img;
        $array["mahasiswa"] = $Arr_group;
        $array['videos'] = videoController::getVideoListFromProyekId($id);
        return $array;
    }

    public static function getProyekByMahasiswaId( int $id ){
        $kelompok = kelompok::where("mahasiswa", $id)->get();
        $proyek = array();
        foreach($kelompok as $kel){
            $idProyek = $kel["proyek"];
            $getProyek = self::getProyekById($idProyek);
            array_push($proyek, $getProyek);
        }
        return $proyek;
    }

    public static function setProyekById(int $id, array $array){
        try {
            $proyek = proyek::findOrFail($id);
            $proyek->update($array);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function delProyekById(int $id, array $array){
        try {
            $proyek = proyek::findOrFail($id);
            $proyek->dropColumn($array);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function createProyek(array $array){
        try {
            proyek::create($array);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function addNewProyek(){
        $userNim = session('account')['nim'];
        $userName = session('account')['nama'];

        if( !isset($_POST['judul']) || $_POST['judul'] == ""){
            return redirect("/profile/$userNim/add-proyek?error='judul tidak valid'");
        }
        
        if( !isset($_POST['dosen_selected']) ){
            return redirect("/profile/$userNim/add-proyek?error='dosen pembimbing tidak ada'");
        }
        if( count($_POST['dosen_selected']) != 2 ){
            return redirect("/profile/$userNim/add-proyek?error='ada yang salah dengan dosennya, coba input ulang'");
        }
        if( !isset($_POST['mahasiswa-nim-list']) && !isset($_POST['mahasiswa-nama-list']) ){
            return redirect("/profile/$userNim/add-proyek?error='kelompokmu kemana semua ?'");
        }
        if( $_POST['mahasiswa-nim-list'][0] != $userNim || $_POST['mahasiswa-nama-list'][0] != $userName ){
            return redirect("/profile/$userNim/add-proyek?error='ada yang salah dengan kelompokmu'");
        }
        if( count($_POST['mahasiswa-nim-list']) != count($_POST['mahasiswa-nama-list'])){
            return redirect("/profile/$userNim/add-proyek?error='apa yang terjadi dengan kelompokmu ?'");
        }

        $dosenInformation = [
            'kode' => $_POST['dosen_selected'][0],
            'nama' => $_POST['dosen_selected'][1]
        ];

        $proyekInfo = [
            'repoCode' => (string)Str::password(7, true, true, false),
            'judul' => (string)$_POST['judul'],
            'deskripsi' => $_POST['deskripsi'],
            'link' => '',
            'dosenId' => DosenController::getDosenIdByKode($dosenInformation['kode']),
            'verifikasi' => 0,
            'proposal' => 0,
            'laporan' => 0,
        ];
        $proyek = proyek::create($proyekInfo);

        $arrayNim = $_POST['mahasiswa-nim-list'];
        $arrayNama = $_POST['mahasiswa-nama-list'];

        $newKelompok = [];
        for($i=0; $i<count( $arrayNim ); $i++){
            $mhs = [
                'nim' => $arrayNim[$i],
                'nama' => $arrayNama[$i]
            ];
            $newteam = [
                'mahasiswa' => mahasiswaController::getMahasiswaIdByNim($mhs['nim']),
                'proyek' => $proyek->id
            ];
            $kelompok = kelompok::create($newteam);
            array_push($newKelompok, $newteam);
        }
        session()->push("account.proyek", $proyekInfo);
        return redirect('/profile/');
    }

    public static function getAllProjectImageByProjectId( int $id ){
        $array = gambarProyek::where("proyekId", (string)$id)->get();
        $pathImageArr = array();

        foreach($array as $imageCollection){
            $imageId = $imageCollection["gambarId"];
            $pathImgCollection = gambar::where("id", (string)$imageId)->get()->first();
            $imagePath = $pathImgCollection["lokasi"];
            array_push($pathImageArr, $imagePath);
        }

        return $pathImageArr;
    }

    public static function isMyProyek($repoCode){
        $myProject = session('account')['proyek'] ?? [];
        
        // Pastikan $myProject adalah iterable (bisa di-loop)
        if (!is_array($myProject) && !is_object($myProject)) {
            return false;
        }
    
        foreach($myProject as $myPr){
            if (is_object($myPr)) {
                if (!($myPr instanceof \__PHP_Incomplete_Class) && isset($myPr->repoCode)) {
                    if ($myPr->repoCode == $repoCode) return true;
                }
            } 
            else if (is_array($myPr)) {
                if (isset($myPr['repoCode']) && $myPr['repoCode'] == $repoCode) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function getProyekByCode($code){
        $proyekId = proyek::where("repoCode", $code)->get()->first()["id"];
        return self::getProyekById($proyekId);
    }

    public function updateProyek(Request $request, $code){
        
        $prevPath = "/repository/$code/edit";
        
        // 1. Ambil data proyek lama (Sangat penting agar data tidak hilang)
        $currentProyek = proyek::where('repoCode', $code)->first();
        if (!$currentProyek) {
            return redirect("$prevPath?error='Proyek tidak ditemukan'");
        }
        $proyekId = $currentProyek->id;

        // 2. Validasi Input Dasar
        if (!isset($_POST['judul']) || $_POST['judul'] == "") {
            return redirect("$prevPath?error='judul tidak valid'");
        }

        /* ==========================================
        PENGELOLAAN GAMBAR (IMAGE)
        ========================================== */
        $imageAmount = isset($_POST['image-amount']) ? (int)$_POST['image-amount'] : 0;

        for ($i = 0; $i < $imageAmount; $i++) {
            $key = "image-proyek-$i";
            if (request()->hasFile($key)) {
                request()->validate([
                    $key => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                ]);

                $newImageName = uniqid() . "." . request()->file($key)->getClientOriginalExtension();
                
                $newGambar = gambar::create([
                    'lokasi' => $newImageName,
                    'imageCode' => uniqid()
                ]);

                gambarProyek::create([
                    'proyekId' => $proyekId,
                    'gambarId' => $newGambar->id
                ]);

                request()->file($key)->move(public_path('images/proyek'), $newImageName);
            }
        }

        // Hapus gambar yang ditandai user
        if (isset($_POST['image-delete-list'])) {
            foreach ($_POST['image-delete-list'] as $imgItem) {
                $gambarDB = gambar::where('imageCode', $imgItem)->first();
                if ($gambarDB) {
                    // Hapus file fisik
                    $filePath = public_path('images/proyek/' . $gambarDB->lokasi);
                    if (file_exists($filePath)) { unlink($filePath); }

                    // Hapus relasi dan data gambar
                    gambarProyek::where('gambarId', $gambarDB->id)->delete();
                    $gambarDB->delete();
                }
            }
        }

        /* ==========================================
        PENGELOLAAN VIDEO
        ========================================== */
        $videoAmount = isset($_POST['video-amount']) ? (int)$_POST['video-amount'] : 0;
        if ($videoAmount > 5) $videoAmount = 5;

        for ($i = 0; $i < $videoAmount; $i++) {
            $key = "video-proyek-$i";
            if (request()->hasFile($key)) {
                request()->validate([
                    $key => 'required|file|mimes:mp4,mov,ogg,mkv|max:204800',
                ]);

                $newVideoName = uniqid() . "." . request()->file($key)->getClientOriginalExtension();
                video::create([
                    'videoCode' => uniqid(),
                    'lokasi' => $newVideoName,
                    'proyekId' => $proyekId
                ]);

                request()->file($key)->move(public_path('videos/proyek'), $newVideoName);
            }
        }

        // Hapus video yang ditandai user
        if (isset($_POST['video-del-list'])) {
            foreach ($_POST['video-del-list'] as $videoCode) {
                $videoDB = video::where('videoCode', $videoCode)->first();
                if ($videoDB) {
                    $videoPath = public_path('videos/proyek/' . $videoDB->lokasi);
                    if (file_exists($videoPath)) { unlink($videoPath); }
                    $videoDB->delete();
                }
            }
        }

        /* ==========================================
        PENGELOLAAN ANGGOTA TIM (MAHASISWA)
        ========================================== */
        if (isset($_POST['mahasiswa-delete-list'])) {
            foreach ($_POST['mahasiswa-delete-list'] as $mahasiswaNIM) {
                $user = users::where('kode', $mahasiswaNIM)->first();
                if ($user) {
                    $mhs = mahasiswa::where('userID', $user->id)->first();
                    if ($mhs) {
                        kelompok::where('mahasiswa', $mhs->id)->where('proyek', $proyekId)->delete();
                    }
                }
            }
        }

        if (isset($_POST['mahasiswa-nim-list']) && isset($_POST['mahasiswa-nama-list'])) {
            $nimList = $_POST['mahasiswa-nim-list'];
            for ($i = 0; $i < count($nimList); $i++) {
                $user = users::where('kode', $nimList[$i])->first();
                if ($user) {
                    $mhs = mahasiswa::where('userID', $user->id)->first();
                    // Gunakan firstOrCreate agar tidak duplikat jika user klik simpan berkali-kali
                    kelompok::firstOrCreate([
                        'mahasiswa' => $mhs->id,
                        'proyek' => $proyekId
                    ]);
                }
            }
        }

        /* ==========================================
        PENGELOLAAN DOKUMEN (LAPORAN & PPT)
        ========================================== */
        // Default: gunakan nama file lama agar tidak terhapus jika tidak ada upload baru
        $laporan_file = $currentProyek->file_laporan;
        $ppt_file = $currentProyek->file_ppt;

        // Update Laporan jika ada file baru
        if (request()->hasFile('laporan-file')) {
            request()->validate(['laporan-file' => 'required|file|mimes:pdf|max:204800']);
            
            // Hapus file fisik lama
            if ($currentProyek->file_laporan && file_exists(public_path('document/Laporan/'.$currentProyek->file_laporan))) {
                unlink(public_path('document/Laporan/'.$currentProyek->file_laporan));
            }

            $laporan_file = uniqid() . '.' . request()->file('laporan-file')->getClientOriginalExtension();
            request()->file('laporan-file')->move(public_path('document/Laporan'), $laporan_file);
        }

        // Cari bagian ini di dalam public function updateProyek
        if (request()->hasFile('ppt-file')) {
            request()->validate([
                'ppt-file' => [
                    'required', 
                    'file', 
                    'max:204800',
                    // Menambahkan mimetypes untuk pptx yang sering terdeteksi sebagai zip/application
                    'mimetypes:application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/zip,application/octet-stream'
                ],
            ]);

            // Hapus file lama jika ada
            if ($currentProyek->file_ppt) {
                $oldPath = public_path('document/PPT/' . $currentProyek->file_ppt);
                if (file_exists($oldPath)) { unlink($oldPath); }
            }

            $ppt_file = uniqid() . '.' . request()->file('ppt-file')->getClientOriginalExtension();
            request()->file('ppt-file')->move(public_path('document/PPT'), $ppt_file);
        }

        /* ==========================================
        SIMPAN PERUBAHAN FINAL
        ========================================== */
        // 1. Cek: Apakah user mengirimkan pilihan dosen baru?
        if ($request->has('dosen_selected') && !empty($request->dosen_selected[0])) {
            // Jika YA (User klik ganti dosen), cari ID berdasarkan kode yang baru dikirim
            $dosenId = DosenController::getDosenIdByKode($request->dosen_selected[0]);
        } else {
            // Jika TIDAK (User tidak menyentuh tombol ganti dosen), 
            // gunakan dosenId yang saat ini sudah tersimpan di database
            $dosenId = $currentProyek->dosenId;
        }

        $proyekInfo = [
            'judul' => (string)$_POST['judul'],
            'deskripsi' => $_POST['deskripsi'],
            'link' => $_POST['link'] ?? '',
            'dosenId' => $dosenId,
            'file_laporan' => $laporan_file, // Menggunakan file lama jika tidak ada upload baru
            'file_ppt' => $ppt_file,         // Menggunakan file lama jika tidak ada upload baru
            'verifikasi' => 0, 
        ];

        proyek::where('repoCode', $code)->update($proyekInfo);

        return redirect("/repository/$code/edit")->with('success', 'Perubahan berhasil disimpan');
    }


    public function deleteProyek($repoCode) {
        $proyek = Proyek::where('repoCode', $repoCode)->first();
        
        if (!$proyek) {
            return redirect()->back()->with('error', 'Proyek tidak ditemukan.');
        }

        $proyekID = $proyek->id;

        // 1. Hapus Gambar (File & Database)
        $imagesProyek = gambarProyek::where('proyekId', $proyekID)->get();
        foreach($imagesProyek as $item) {
            $imgData = gambar::find($item->gambarId);
            if ($imgData) {
                $path = public_path('images/proyek/' . $imgData->lokasi);
                if (file_exists($path)) { unlink($path); }
                $imgData->delete();
            }
            $item->delete();
        }

        // 2. Hapus Video (File & Database)
        $videos = video::where('proyekId', $proyekID)->get();
        foreach($videos as $video) {
            $path = public_path('videos/proyek/' . $video->lokasi);
            if (file_exists($path)) { unlink($path); }
            $video->delete();
        }

        // 3. Hapus Dokumen Laporan & PPT (PENTING: Tambahkan ini)
        if ($proyek->file_laporan) {
            $pathLaporan = public_path('document/Laporan/' . $proyek->file_laporan);
            if (file_exists($pathLaporan)) { unlink($pathLaporan); }
        }
        if ($proyek->file_ppt) {
            $pathPPT = public_path('document/PPT/' . $proyek->file_ppt);
            if (file_exists($pathPPT)) { unlink($pathPPT); }
        }

        // 4. Hapus Anggota Kelompok
        kelompok::where('proyek', $proyekID)->delete();

        // 5. Hapus Data Utama Proyek
        $proyek->delete();

        return redirect('/')->with('success', 'Proyek berhasil dihapus permanen.');
    }
}