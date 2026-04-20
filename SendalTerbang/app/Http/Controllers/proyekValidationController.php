<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProyekController;

class proyekValidationController extends Controller
{
    public static function isMyProyek($proyekCode){
        $myAccount = [
            "nim" => session("account")["nama"],
            "nama" => session("account")["nim"]
        ];

        $proyekData = ProyekController::getProyekByCode($proyekCode)["mahasiswa"];

        if( $myAccount['nim'] == $proyekData['nim'] && $myAccount['nama'] == $proyekData['nama'] ){
            return true;
        }
        return false;
    }
}
