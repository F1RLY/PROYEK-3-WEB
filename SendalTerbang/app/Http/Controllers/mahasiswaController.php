<?php

namespace App\Http\Controllers;
use App\Models\mahasiswa;
use App\Models\Users;
use App\Http\Controllers\kelompokController;
use App\Http\Controllers\proyekController;
use App\Http\Controllers\sosialMediaController;
use App\Models\user;
use App\Models\proyek;
use App\Models\kelompok;
use App\Models\sosialMedia;
use App\Models\sosialMediaMahasiswa;
use Illuminate\Http\Request;

class mahasiswaController extends Controller
{

    public static function getAllMahasiswa(){
        $mahasiswa_List_result = [];

        $mahasiswa_array = mahasiswa::all();

        foreach($mahasiswa_array as $mhs){
            if($mhs["userID"] != 0){
                $mahasiswaID = $mhs["id"];
                $mahasiswa = self::getMahasiswaById($mahasiswaID);
                array_push($mahasiswa_List_result, $mahasiswa);
            }
        }
        
        return $mahasiswa_List_result;
    }

    public static function getMahasiswaListFromKeyword($keyword){
        $mahasiswa_List_result = [];
        $mahasiswa_list_id = [];

        $array_nim = Users::where("kode", "like", "%".(string)$keyword."%")->where('role', 'mahasiswa')->get();
        $array_nama = Users::where("username", "like", "%".(string)$keyword."%")->where('role', 'mahasiswa')->get();
        
        foreach($array_nim as $index){
            $mahasiswaID = $index["id"];
            if( !in_array($mahasiswaID, $mahasiswa_list_id)){
                array_push($mahasiswa_list_id, $mahasiswaID);
            }
        }
        foreach($array_nama as $index){
            $mahasiswaID = $index["id"];
            if( !in_array($mahasiswaID, $mahasiswa_list_id) ){
                array_push($mahasiswa_list_id, $mahasiswaID);
            }
        }

        foreach( $mahasiswa_list_id as $id){
            $mahasiswa = self::getMahasiswaFromUserId($id);
            array_push($mahasiswa_List_result, $mahasiswa);
        }

        return $mahasiswa_List_result;
    }
    
    public static function getMahasiswaFromUserId(int $id){
        $mahasiswaID = mahasiswa::where("userID", $id)->get()->first()["id"];
        $mahasiswaData = self::getMahasiswaById($mahasiswaID);
        return $mahasiswaData;
    }

    public static function getMahasiswaById( int $id ){

        $mahasiswaData = mahasiswa::select('id', 'userID', 'angkatan', 'kelas', 'link')->where('id', $id)->first();
        $userData = Users::select('username', 'kode', 'email')->where('id', $mahasiswaData['userID'])->first();
        $KelompokList = kelompok::select('proyek')->where('mahasiswa', $mahasiswaData['id'])->get();
        $sosialMediaList = sosialMediaMahasiswa::select('sosial_media_id', 'link')->where('mahasiswa_id')->get();
        $proyek = array();

        foreach($KelompokList as $kelompok){
            $proyekID = $kelompok['proyek'];
            $proyekData = proyek::select('judul', 'repoCode')->where('id', $proyekID)->first();
            array_push($proyek, $proyekData);
        }
        foreach($sosialMediaList as $sosmed){
            $sosmedName = sosialMedia::select('nama')->where('id', $sosmed['sosial_media_id'])->first()['nama'];
            $sosmed['nama'] = $sosmedName;
        }

        $mahasiswa = array(
            "nama" => $userData['username'],
            "nim" => $userData['kode'],
            "kelas" => $mahasiswaData['kelas'],
            "email" => $userData['email'],
            "angkatan" => $mahasiswaData['angkatan'],
            "link" => $mahasiswaData['link'],
            "sosial_media" => $sosialMediaList,
            "proyek" => $proyek
        );

        return $mahasiswa;
    }

    public static function getMahasiswaByNim($nim){
        $userID = Users::where("kode", (string)$nim)->get()->first()["id"];
        $mahasiswaID = mahasiswa::where('userID', $userID)->first()['id'];
        $mahasiswa = self::getMahasiswaById($mahasiswaID);
        return $mahasiswa;
    }

    public static function addMahasiswa( array $mahasiswa){
        $userData = [
            'username' => $mahasiswa["nama"],
            'kode' => $mahasiswa["nim"],
            'email' => $mahasiswa["email"],
            'role' => "mahasiswa",
            'password' => bcrypt($mahasiswa["password"])
        ];

        $newUser = Users::create($userData);
        $userId = $newUser->id;

        $mahasiswaData = [
            "userID" => (int)$userId,
            "angkatan" => (int)$mahasiswa["angkatan"],
            "kelas" => (string)$mahasiswa["kelas"]
        ];
        $newMahasiswa = mahasiswa::create($mahasiswaData);
        return true;
    }

    public static function isExist( array $mahasiswa ){
        $nim = $mahasiswa["nim"];
        if( count(self::getMahasiswaListFromKeyword($nim)) > 0 ){
            return true;
        }
        return false;
    }

    public static function getNameAndNimById( int $id ){
        $mahasiswaQueary = self::getMahasiswaById($id);
        $data = array(
            "nim" => $mahasiswaQueary['nim'],
            "nama" => $mahasiswaQueary['nama']
        );
        return $data;
    }

    public static function getMahasiswaIdByNim( $nim ){
        $userId = Users::where('kode', (string)$nim)->get()->first()['id'];
        $mahasiswaId = mahasiswa::where('userID', (string)$userId)->get()->first()['id'];

        return $mahasiswaId;
    }

    
    public static function getFewMahasiswa($search = null){
        $query = Users::where('role', 'mahasiswa');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', '%' . $search . '%')
                ->orWhere('kode', 'like', '%' . $search . '%');
            });
        }
        
        $mahasiswaList = $query->orderBy('username')->get();
        
        $mahasiswaFinalList = array();
        foreach($mahasiswaList as $mhs){
            $newData = [
                'nim' => $mhs['kode'],
                'nama' => $mhs['username']
            ];
            array_push($mahasiswaFinalList, $newData);
        }
        
        return $mahasiswaFinalList;
    }

}
