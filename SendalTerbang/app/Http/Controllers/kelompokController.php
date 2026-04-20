<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelompok;
use App\Models\proyek;
use App\Models\mahasiswa;
use App\Models\Users;
use App\Http\Controllers\mahasiswaController;

class kelompokController extends Controller
{
    public static function getKelompokFromProyek(int $id_proyek){
        $kelompok = kelompok::where("proyek", $id_proyek)->get();
        $mahasiswa = array();

        foreach( $kelompok as $anggota ){
            $mhsId = $anggota['mahasiswa'];
            $userId = mahasiswa::where('id', $mhsId)->get()->first()['userID'];
            $userData = Users::where('id', $userId)->get()->first();
            $finalData = [
                'nama' => $userData['username'],
                'nim' => $userData['kode']
            ];
            array_push($mahasiswa, $finalData);
        }
        return $mahasiswa;
    }

    public static function getProyekFromMahasiswa(int $id_mahasiswa){
        $kelompok = kelompok::where("mahasiswa", $id_mahasiswa)->get();
        $proyek = array();
        foreach($kelompok as $kel){
            $idProyek = $kel["proyek"];
            $getProyek = proyek::where("id", $idProyek)->get()->first();
            array_push($proyek, $getProyek);
        }
        return $proyek;
    }

    public static function addKelompok( int $proyekId, array $mahasiswa_array){
        foreach($mahasiswa_array as $anggota){
            $anggotaData = [
                "mahasiswa" => $anggota["id"],
                "proyek" => $proyekId
            ];
            kelompok::create($anggotaData);
        }
    }

    public static function makeKelompokFromNimAndNama(array &$nim, array &$nama){
        $indexN = count($nim) >= count($nama) ? count($nim) : count($nama);
        $mahasiswaList = array();

        for($i=0; $i<$indexN; $i++){
            $newMahasiswa = [
                'nim' => $nim[$i],
                'nama' => $nama[$i]
            ];
            array_push($mahasiswaList, $newMahasiswa);
        }
        return $mahasiswaList;
    }

    // public static function updatedKelompok( int &$idProyek, array &$oldKelompok, array &$newKelompok){
    //     foreach($oldKelompok as $oldMahasiswa){
    //         if( !in_array($oldMahasiswa, $newKelompok) ){
    //             $mahasiswaId = mahasiswa::where('nim', $oldMahasiswa['nim'])->get()->first()['id'];
    //             $teamID = kelompok::where('proyek', $idProyek)->where('mahasiswa', $mahasiswaId);
    //             $teamID->delete();
    //         }
    //     }
    //     foreach($newKelompok as $newMahasiswa){
    //         if( !in_array($newMahasiswa, $oldKelompok) ){
    //             $userId = Users::where('kode', $newMahasiswa['nim'])->get()->first()['id'];
    //             $mahasiswaId = mahasiswa::where('userID', $userId)->get()->first()['id'];
    //             $newData = [
    //                 'proyek' => $idProyek,
    //                 'mahasiswa' => $mahasiswaId
    //             ];
    //             kelompok::create($newData);
    //         }
    //     }
    // }

}
