<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class API_Reject_API extends Controller
{
    public static function checkKey(){
        return false;
        // return session('SELF_API_KEY') == env('API_KEY');
    }

    public static function getRejectAPI(string $massage){
        $response = [
            "massage" => $massage,
            "success" => false,
            "mahasiswa-data" => null
        ];
        return response()->json($response, Response::HTTP_OK );
    }
}
