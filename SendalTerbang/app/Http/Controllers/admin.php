<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\proyekController;
use App\Models\proyek;
use App\Models\kelompok;
use App\Models\mahasiswa;
use App\Models\sosialMedia;
use App\Models\Hash;
use App\Models\sosialMediaMahasiswa;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

class admin extends Controller
{
    public function admin( ){
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }
        $part = 'dashboard';
        $mahasiswa = mahasiswaController::getAllMahasiswa();
        $proyek = proyek::select('judul', 'link', 'updated_at')->limit(5)->get();
        $proyekAmount = count($proyek);
        $proyek_ver = proyek::where("verifikasi", true)->get();
        return view("layouts/admin", compact("part", "mahasiswa", "proyekAmount", "proyek", "proyek_ver"));
    }
    public function kelolaAkun(){
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }

        $part = 'kelolaAkun';
        $page = "kelolaAkun";
        
        if( isset($_GET["keyword"]) ){
            $keyword = $_GET["keyword"];
            $search_history = $keyword;
            $mahasiswa = mahasiswaController::getMahasiswaListFromKeyword($keyword);
            return view("layouts/admin", compact("part", "mahasiswa", "search_history"));
        }else{
            $mahasiswa = mahasiswaController::getAllMahasiswa();
            $search_history = "";
            return view("layouts/admin", compact("part", "mahasiswa", "search_history") );
        }
    }

    public function kelolaProyek(){
        
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }

        $part = 'kelolaProyek';

        if(isset($_GET["keyword"])){
            $keyword = $_GET["keyword"];
            $proyek = proyekController::getProyekByKeyWord($keyword);
            return view("layouts/admin", compact("part", "proyek", "keyword"));
        }else{
            $proyek = proyek::all();
            return view("layouts/admin", compact("part", "proyek"));
        }
    }
    
    public function kelolaDosen(){
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }

        $part = 'kelolaDosen';

        if(isset($_GET["keyword"])){
            $keyword = $_GET["keyword"];
            $proyek = proyekController::getProyekByKeyWord($keyword);
            return view("layouts/admin", compact("part", "proyek", "keyword"));
        }else{
            $proyek = proyek::all();
            return view("layouts/admin", compact("part", "proyek"));
        }
    }
    public function tambahDosen(){
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }

        $part = 'tambahDosen';

        return view("layouts/admin", compact("part"));

    }

    public function detailProyek($code){
        
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }

        $part = 'detailProyek';
        $proyek = proyek::select('id', 'judul', 'deskripsi', 'link', 'file_laporan', 'file_ppt', 'dosenId')->where('repoCode', $code)->first();
        $images = [];

        $mahasiswaTeamArrayId = kelompok::select('mahasiswa')->where('proyek', $proyek['id'])->get();
        $mahasiswaArr = array();

        foreach($mahasiswaTeamArrayId as $mhsID){
            $userID = mahasiswa::select('userID')->where('id', $mhsID['mahasiswa'])->first()['userID'];
            $mahasiswa = Users::select('username', 'kode')->where('id', $userID)->first();
            array_push($mahasiswaArr, $mahasiswa);
        }
        $dosen = Users::where('id', $proyek['id'])->select('username')->first();

        return view("layouts/admin", compact("part", "proyek", 'dosen', 'mahasiswaArr'));
    }

    public function detailAkun($nim = "0000000"){
        
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }

        $part = 'detailMahasiswa';
        $userData = Users::select('id', 'username', 'kode', 'email')->where('kode', $nim)->first();
        $mahasiswaData = mahasiswa::select('id', 'angkatan', 'link', 'kelas')->where('userID', $userData['id'])->first();
        $kelompokData = kelompok::select('proyek')->where('mahasiswa', $mahasiswaData['id'])->get();
        $sosialMediaList = sosialMediaMahasiswa::select('sosial_media_id', 'link')->where('mahasiswa_id', $mahasiswaData['id'])->get();
        $proyekData = array();

        foreach($kelompokData as $klmpk){
            $proyekId = $klmpk['proyek'];
            $proyek = proyek::select('judul', 'repoCode')->where('id', $proyekId)->first();
            // echo $proyek.'<br>';
            array_push($proyekData, $proyek);
        }
        foreach($sosialMediaList as $sosmed){
            $sosmedID = $sosmed['sosial_media_id'];
            $sosialMediaName = sosialMedia::select('nama')->where('id', $sosmedID)->first()['nama'];
            $sosmed['nama'] = $sosialMediaName;
        }

        $mahasiswa = [
            'nim' => $userData['kode'],
            'email' => $userData['email'],
            'nama' => $userData['username'],
            'angkatan' => $mahasiswaData['angkatan'],
            'link' => $mahasiswaData['link'],
            'kelas' => $mahasiswaData['kelas'],
            'proyek' => $proyekData,
            'sosial-media' => $sosialMediaList,
        ];

        return view("layouts/admin", compact("part", "mahasiswa"));
    }
    
    public function HalamanTambahAkun(){
        
        if( !session("login") || !Auth::user()->role === 'admin'){
            return redirect("/home");
        }
        
        $part = "tambahMahasiswa";
        return view("layouts/admin", compact("part"));
    }
    
    public function vertifikasi( ){

        $part = 'vertifikasi';
        return view("layouts/admin", compact("part"));
    }
    public function kelolaDanPenilaian( ){

        $part = 'kelolaDanPenilaian';
        return view("layouts/admin", compact("part"));
    }
    
    public function createMhsAcc( Request $request ){
        $part = "tambahMahasiswa";
        $mahasiswa = $request->all();

        if(mahasiswaController::isExist($mahasiswa)){
            return redirect("/admin-tambah-akun");
        }

        if ( mahasiswaController::addMahasiswa($mahasiswa) ){
            return redirect("/admin-kelola-akun");
        }else{
            return redirect("/admin-tambah-akun");
        }
    }
}
