<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dosen;
use App\Models\Users;
use App\Http\Controllers\DosenController;
use Symfony\Component\HttpFoundation\Response;

class API_DosenController extends Controller
{
    public function getDosenListByKeyword($keyword = ""){
        $dosenListData = DosenController::getDosenByKeyword($keyword);
        $response = [
            'massage' => 'successful get dosen data',
            'success' => true,
            'data' => $dosenListData
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function index(){
        $dosenList = users::select('username', 'kode')->where('role', 'dosen')->orderBy('updated_at', 'desc')->get();
        $response = [
            'massage' => 'successful get dosen data',
            'success' => true,
            'data' => $dosenList
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function getDosentListFromKeyword($keyword = ''){
        $dosenList = users::select('username', 'kode')
        ->where('role', 'dosen')
        ->where('username', 'like', '%'.$keyword.'%')
        ->orderBy('updated_at', 'desc')
        ->get();

        $response = [
            'massage' => 'successful get dosen data',
            'success' => true,
            'data' => $dosenList
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
