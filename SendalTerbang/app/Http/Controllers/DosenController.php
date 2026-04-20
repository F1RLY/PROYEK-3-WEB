<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class DosenController extends Controller
{
    public static function getFewDosen(){
        $dosen = Users::where('role', 'dosen')->limit(10)->get();
        $dosenNameList = array();

        foreach($dosen as $dsn){
            $dosenData = [
                'nama' => $dsn['username'],
                'kode' => $dsn['kode']
            ];
            array_push($dosenNameList, $dosenData);
        }
        return $dosenNameList;
    }
    public static function getDosenByKeyword($keyword = ""){
        if($keyword == ""){
            return self::getFewDosen();
        }else{
            $getDosenData = Users::where('username', "like", "%".(string)$keyword."%")->where('role', "dosen")->get();
            $Dosen = array();
            
            foreach($getDosenData as $dsnData){
                $selfData = [
                    'nama' => $dsnData['username'],
                    'kode' => $dsnData['kode']
                ];
                array_push($Dosen, $selfData);
            }

            return $Dosen;
        }
    }
    public static function getDosenIdByKode($kode){
        $dosenId = Users::where('kode', $kode)->where('role', 'dosen')->get()->first()['id'];
        return $dosenId;
    }

    public static function getDosenByKode($kode){
        $dosenQuery = Users::where('kode', $kode)->where('role', 'dosen')->get()->first();
        $dosenData = [
            'nim' => (string)$dosenQuery['kode'],
            'nama' => (string)$dosenQuery['username']
        ];
        return $dosenData;
    }
    public static function getDosenById($id){
        $dosenQuery = Users::where('id', $id)->where('role', 'dosen')->get()->first();
        $dosenData = [
            'kode' => (string)$dosenQuery['kode'],
            'nama' => (string)$dosenQuery['username']
        ];
        return $dosenData;
    }

    public function tambahDosen(){
        request()->validate([
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|max:16',
            'password_confirmation' => 'required|max:16'
        ]);

        $emailUsed = count(users::where('email', request()->get('email'))->get()) > 1;
        $isPasswordSame = request('password') == request('password_confirmation');

        if($emailUsed){
            return redirect("admin-tambah-dosen?error='email sudah dipakai sebelumnya'");
        }
        if( !$isPasswordSame ){
            return redirect("admin-tambah-dosen?error='password tidak valid'");
        }

        $newDosen = users::create([
            'kode' => uniqid(),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role' => 'dosen'
        ]);

        return redirect('/admin-kelola-dosen');

    }

}
