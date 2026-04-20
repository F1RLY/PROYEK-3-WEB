<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sosialMedia;
use App\Models\socialMediaMahasiswa;
use App\Models\sosialMediaMahasiswa;

class sosialMediaController extends Controller
{
    public static function getSosialMediaByIdMahasiswa(int $id){
        $mahasiswaID = $id;
        
        $arraySosialMediaCollection = sosialMediaMahasiswa::where("mahasiswa_id", (string)$mahasiswaID)->get();

        $arraySosialMediaName = array();

        foreach($arraySosialMediaCollection as $sm){
            $socialMediaId = $sm["sosial_media_id"];
            $socialMediaName = sosialMedia::where("id", $socialMediaId)->first();
            array_push($arraySosialMediaName, $socialMediaName);
        }

        $arraySocialMediaResult = array();
        
        for( $i=0; $i<count($arraySosialMediaName); $i++){
            $name = $arraySosialMediaName[$i]["nama"];
            $link = $arraySosialMediaCollection[$i]["link"];
            $newCollection = [
                'nama' => $name,
                'link' => $link
            ];
            array_push($arraySocialMediaResult, $newCollection);
        }

        return $arraySocialMediaResult;
    }
}
