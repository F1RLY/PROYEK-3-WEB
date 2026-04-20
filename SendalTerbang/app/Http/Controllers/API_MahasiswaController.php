<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Models\Users;
use App\Http\Controllers\mahasiswaController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\API_Reject_API;

class API_MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($index = 1)
    {
        try {
            if( API_Reject_API::checkKey() ){
                return API_Reject_API::getRejectAPI("Sorry, you can't access this API");
            }

            $limit = 10;
            $mahasiswaQuery = mahasiswa::orderBy("created_at", "desc")->offset(pow(10, $index-1)-1)->take($limit)->get();
            $mahasiswaData = array();
            foreach($mahasiswaQuery as $mhs){
                $mahasiswaSingleData = mahasiswaController::getMahasiswaById($mhs['id']);
                array_push($mahasiswaData, $mahasiswaSingleData);
            }
            $response = [
                "massage" => "successfull get mahasiswa data",
                "success" => true,
                "data" => $mahasiswaData
            ];
            return response()->json($response, Response::HTTP_OK );
        } catch (\Throwable $th) {
            $response = [
                "massage" => "failed to get mahasiswa data",
                "success" => false,
                "mahasiswa-data" => null
            ];
            return response()->json($response, Response::HTTP_OK );
        }
    }
    public function getByKeyword($keyword = "")
    {
        try {
            $limit = 10;
            $mahasiswaData = mahasiswaController::getMahasiswaListFromKeyword($keyword);
            
            $response = [
                "massage" => "successfull get mahasiswa data",
                "success" => true,
                "data" => $mahasiswaData
            ];
            return response()->json($response, Response::HTTP_OK );
        } catch (\Throwable $th) {
            $response = [
                "massage" => "failed to get mahasiswa data",
                "success" => false,
                "mahasiswa-data" => null
            ];
            return response()->json($response, Response::HTTP_OK );
        }
    }

    public function getByNim($nim = "0000000")
    {
        try {
            if( API_Reject_API::checkKey() ){
                return API_Reject_API::getRejectAPI("Sorry, you can't access this API");
            }
            $userQueryID = Users::where("kode", $nim)->get()->first()['id'];
            $mahasiswaiD = mahasiswa::where("userID", $userQueryID)->get()->first()['id'];

            $mahasiswaData = mahasiswaController::getMahasiswaById($mahasiswaiD);

            $response = [
                "massage" => "successfull get mahasiswa data by nim = $nim",
                "success" => true,
                "data" => $mahasiswaData
            ];
            return response()->json($response, Response::HTTP_OK );
        } catch (\Throwable $th) {
            $response = [
                "massage" => "failed to get mahasiswa data",
                "success" => false,
                "data" => null
            ];
            return response()->json($response, Response::HTTP_OK );
        }
    }

    public function getUser(){
        if( API_Reject_API::checkKey() ){
                return API_Reject_API::getRejectAPI("Sorry, you can't access this API");
        }
        $response = [
                "massage" => "failed to get mahasiswa data",
                "success" => false,
                "data" => session('account')
            ];
        return response()->json($response, Response::HTTP_OK );
    }

    public function getMahasiswaListByKeyword($keyword = "")
    {
        // try {
            $limit = 10;

            if($keyword != ""){
                $mahasiswaData = Users::where('username', 'like', '%'.(string)$keyword.'%')->where('role', 'mahasiswa')->limit(10)->get();
                $mahasiswa = array();
    
                foreach($mahasiswaData as $mhsData){
                    $dataVisible = [
                        'nama' => $mhsData['username'],
                        'nim' => $mhsData['kode']
                    ];
                    array_push($mahasiswa, $dataVisible);
                }
            }else{
                $mahasiswa = array();
            }

            $response = [
                "massage" => "successfull get mahasiswa data",
                "success" => true,
                "data" => $mahasiswa
            ];
            return response()->json($response, Response::HTTP_OK );
        // } catch (\Throwable $th) {
        //     $response = [
        //         "massage" => "failed to get mahasiswa data",
        //         "success" => false,
        //         "mahasiswa-data" => null
        //     ];
        //     return response()->json($response, Response::HTTP_OK );
        // }
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mahasiswa $mahasiswa)
    {
        //
    }
}
